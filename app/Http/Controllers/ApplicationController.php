<?php

namespace App\Http\Controllers;

use App\Mail\InstructorAssignedMail;
use App\Mail\StudentAssignedMail;
use App\Models\Application;
use App\Models\ATC;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Applications controller
 *
 * Handles CRUD logic for creating and managing controller applications
 *
 * @author Gustavo Valdez <gvaldezsan@gmail.com>
 */
class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();

        return view('dashboard.training.applications.index', compact('applications'));
    }

    /**
     * Checks if the user has already applied. If not, shows the form.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();

        if (! $user) {
            session()->put('url.intended', route('auth.login'));

            return redirect('/auth/redirect');
        }

        if ($user->application) {
            return view('applications.exists');
        }

        return view('applications.create');
    }

    /**
     * Creates an application linked the currently logged in user.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check for existing applications for this user

        $application = new Application;
        $application->email = $request->input('email');
        $application->message = strtolower(trim($request->input('message')));

        try {
            $user->application()->save($application);
        } catch (QueryException $e) {
            // TODO: Handle the error
            return dd('Someone went wrong with the query. Try again');
        }

        activity()
            ->performedOn($application)
            ->log('Created new ATC application for himself');

        return redirect()->route('home')->with('success', 'Tu aplicación de CTA ha sido enviada con éxito. En cuanto haya un instructor disponible se pondra en contacto contigo.');
    }

    public function show($id)
    {
        if (\Auth::user()->hasPermissionTo('view trashed')) {
            $application = Application::withTrashed()->where('id', $id)->firstOrFail();

            if ($application->trashed()) {
                \Session::flash('error', 'Estas viendo un registro que fue borrado. Esta almacenado para motivos de auditoría y solo puede ser visto por administradores.');
            }
        } else {
            $application = Application::where('id', $id)->firstOrFail();
        }

        $instructors = Instructor::all();

        if (App::environment() == 'local') {
            $request = Http::get('https://api.vatsim.net/api/ratings/1303345/');
        } else {
            $request = Http::get('https://api.vatsim.net/api/ratings/'.$application->user->cid.'/');
        }
        $vatsim = $request->json();

        return view('dashboard.training.applications.show', compact('application', 'vatsim', 'instructors'));
    }

    public function assign(Request $request, $id)
    {
        if ($request->instructor == null) {
            return redirect('/ops/training/applications/'.$id)->with('error', 'Es necesario seleccionar un instructor!');
        }

        $application = Application::where('id', $id)->first();

        // Until we can figure out a way to get the stupid selectivity to send value instead of the string,
        // we have to do it manually
        $instructorCid = explode(' ', $request->instructor)[0];

        $studentUser = $application->user;
        $instructorUser = User::where('cid', $instructorCid)->first();

        // Mark the application as processed
        $application->processed = true;
        $application->save();

        // Get the Vatsim Rank for the CID
        if (App::environment() == 'local') {
            $request = Http::get('https://api.vatsim.net/api/ratings/1303345/');
        } else {
            $request = Http::get('https://api.vatsim.net/api/ratings/'.$application->user->cid.'/');
        }
        $vatsim = $request->json();

        // Create and assign the ATC Profile
        $studentAtc = new ATC;
        $studentAtc->initials = '--'; // Todo: add initials on assigns
        $studentAtc->rank = $vatsim['rating'];
        $studentAtc->inactive = false;
        $studentAtc->is_training = true;
        $studentUser->atc()->save($studentAtc);
        $instructorUser->instructor_profile->atcs()->save($studentUser->atc);

        activity()
            ->performedOn($application)
            ->log('Accepted ATC application from user '.$studentUser->name.' - '.$studentUser->cid);

        try {
            Mail::to($application->email)->send(new InstructorAssignedMail($application));

            $instructorEmail = '';
            if ($instructorUser->staff) {
                $instructorEmail = $instructorUser->staff->email;
            } else {
                $instructorEmail = $instructorUser->email;
            }
            Mail::to($instructorEmail)->send(new StudentAssignedMail($application));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return redirect()->route('dashboard.applications.show', ['id' => $id])->with('error', 'Solicitud asignada con éxito sin embargo hubo un error al mandar los correo de notificación. Por favor contact manualmente a los involucrados.');
        }

        return redirect()->route('dashboard.applications.show', ['id' => $id])->with('success', 'Esta solicitud CTA ha sido exitosamente asignada a '.$instructorUser->name.'!');
    }

    /**
     * Delete the application for the currently logged in user
     *
     * @return Response
     */
    public function destroy()
    {
        $user = Auth::user();

        if (! $user) {
            return redirect('/');
        }

        $application = $user->application;
        $application->delete();

        activity()
            ->performedOn($application)
            ->log('Deleted ATC application for himself');

        return redirect()->route('home')->with('success', 'Tu aplicación de CTA ha sido eliminada con éxito!');
    }
}
