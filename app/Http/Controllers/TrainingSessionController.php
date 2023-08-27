<?php

namespace App\Http\Controllers;

use App\Mail\TrainingSessionCanceledEmail;
use App\Mail\TrainingSessionScheduledEmail;
use App\Mail\TrainingSessionUpdatedEmail;
use App\Models\TrainingSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TrainingSessionController extends Controller
{
    public function show(int $id)
    {
        $session = TrainingSession::where('id', $id)->firstOrFail();

        return view('dashboard.trainingSessions.show', compact('session'));
    }

    public function create(int $cid)
    {
        $student = User::where('cid', $cid)->firstOrFail()->atc;

        return view('dashboard.trainingSessions.create', compact('student'));
    }

    public function store(Request $request, int $cid)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'scheduled_time' => ['required', 'after_or_equal:today'],
            'description' => ['nullable', 'string'],
        ]);

        $student = User::where('cid', $cid)->first()->atc;

        $session = new TrainingSession;
        $session->title = $request->input('title');
        $session->created_by = \Auth::user()->cid;
        $session->scheduled_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('scheduled_time'), 'America/Mexico_City')->setTimezone('UTC');
        $session->description = $request->input('description');

        $student->sessions()->save($session);

        activity()
            ->performedOn($session)
            ->withProperties([
                'title' => $request->input('title'),
                'scheduled_time' => Carbon::createFromFormat('Y-m-d\TH:i', $request->input('scheduled_time'), 'America/Mexico_City')->setTimezone('UTC'),
                'description' => $request->input('description'),
            ])->log('Created training session on '.$student->user->name.' - '.$student->user->cid);

        try {
            $studentEmail = $session->student->user->email;

            $instructor = User::where('cid', $session->created_by)->first();
            $instructorEmail = '';
            if ($instructor->staff) {
                $instructorEmail = $instructor->staff->email;
            } else {
                $instructorEmail = $instructor->email;
            }

            Mail::to($studentEmail)->send(new TrainingSessionScheduledEmail($session));
            Mail::to($instructorEmail)->send(new TrainingSessionScheduledEmail($session));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return redirect()->route('dashboard.students.show', ['cid' => $session->student->user->cid])->with('error', 'Sesión de entrenamiento cancelada con éxito sin embargo hubo un error al mandar los correo de notificación. Por favor contact manualmente a los involucrados.');
        }

        return redirect()->route('dashboard.students.show', ['cid' => $student->user->cid])->with('success', 'Sesión de entrenamiento agendada con éxito');
    }

    public function edit(int $id)
    {
        $session = TrainingSession::where('id', $id)->first();

        return view('dashboard.trainingSessions.edit', compact('session'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'scheduled_time' => ['required', 'after_or_equal:today'],
            'description' => ['nullable', 'string'],
        ]);

        $session = TrainingSession::where('id', $id)->first();
        $session->title = $request->input('title');
        $session->scheduled_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('scheduled_time'), 'America/Mexico_City')->setTimezone('UTC');
        $session->description = $request->input('description');

        $session->save();

        activity()
            ->performedOn($session)
            ->withProperties([
                'title' => $request->input('title'),
                'scheduled_time' => Carbon::createFromFormat('Y-m-d\TH:i', $request->input('scheduled_time'), 'America/Mexico_City')->setTimezone('UTC'),
                'description' => $request->input('description'),
            ])->log('Updated training session on '.$session->student->user->name.' - '.$session->student->user->cid);

        try {
            $studentEmail = $session->student->user->email;

            $instructor = User::where('cid', $session->created_by)->first();
            $instructorEmail = '';
            if ($instructor->staff) {
                $instructorEmail = $instructor->staff->email;
            } else {
                $instructorEmail = $instructor->email;
            }

            Mail::to($studentEmail)->send(new TrainingSessionUpdatedEmail($session));
            Mail::to($instructorEmail)->send(new TrainingSessionUpdatedEmail($session));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return redirect()->route('dashboard.students.show', ['cid' => $session->student->user->cid])->with('error', 'Sesión de entrenamiento cancelada con éxito sin embargo hubo un error al mandar los correo de notificación. Por favor contact manualmente a los involucrados.');
        }

        return redirect()->route('dashboard.students.show', ['cid' => $session->student->user->cid])->with('success', 'Sesión de entrenamiento actualizada con éxito');
    }

    public function cancel(int $id)
    {
        $session = TrainingSession::where('id', $id)->first();

        return view('dashboard.trainingSessions.cancel', compact('session'));
    }

    public function remove(Request $request, int $id)
    {
        $session = TrainingSession::where('id', $id)->first();

        $session->canceled = true;
        $session->cancelation_time = Carbon::now();
        $session->cancelation_motive = $request->input('cancelation_motive');

        $session->save();

        activity()
            ->performedOn($session)
            ->log('Canceled training session on '.$session->student->user->name.' - '.$session->student->user->cid);

        try {
            $studentEmail = $session->student->user->email;

            $instructor = User::where('cid', $session->created_by)->first();
            $instructorEmail = '';
            if ($instructor->staff) {
                $instructorEmail = $instructor->staff->email;
            } else {
                $instructorEmail = $instructor->email;
            }

            Mail::to($studentEmail)->send(new TrainingSessionCanceledEmail($session));
            Mail::to($instructorEmail)->send(new TrainingSessionCanceledEmail($session));
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return redirect()->route('dashboard.students.show', ['cid' => $session->student->user->cid])->with('error', 'Sesión de entrenamiento cancelada con éxito sin embargo hubo un error al mandar los correo de notificación. Por favor contact manualmente a los involucrados.');
        }

        return redirect()->route('dashboard.students.show', ['cid' => $session->student->user->cid])->with('success', 'Sesión de entrenamiento cancelada con éxito');
    }
}
