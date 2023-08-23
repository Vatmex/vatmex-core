<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();

        return view('dashboard.staff.index', compact('staffs'));
    }

    public function show($id)
    {
        if (\Auth::user()->hasPermissionTo('view trashed')) {
            $staff = Staff::withTrashed()->where('id', $id)->firstOrFail();

            if($staff->trashed()) {
                \Session::flash('error','Estas viendo un registro que fue borrado. Esta almacenado para motivos de auditoría y solo puede ser visto por administradores.');
            }
        }
        else {
            $staff = Staff::where('id', $id)->firstOrFail();
        }
        
        $users = User::all();

        return view('dashboard.staff.show', compact('staff', 'users'));
    }

    public function create()
    {
        $teams = Team::all();

        return view('dashboard.staff.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'position' => ['required', 'string'],
            'shortcode' => ['required', 'string'],
        ]);

        $staff = new Staff;
        $staff->position = $request->input('position');
        $staff->shortcode = $request->input('shortcode');
        $staff->description = $request->input('description');
        $staff->email = $request->input('email');

        $staff->save();

        $team = Team::where('name', $request->input('team'))->first();

        $staff->team()->associate($team);
        $staff->save();

        activity()
            ->performedOn($staff)
            ->withProperties([
                'position' => $request->input('position'),
                'shortcode' => $request->input('shortcode'),
                'description' => $request->input('description'),
                'email' => $request->input('email'),
            ])->log('Created staff position '.$staff->position);
        
        return redirect()->route('dashboard.staff.show', ['id' => $staff->id])->with('success', 'Se creó la posición '.$staff->position.' con éxito!');
    }

    public function edit(int $id)
    {
        $staff = Staff::where('id', $id)->firstOrFail();

        return view('dashboard.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'position' => ['required', 'string'],
            'shortcode' => ['required', 'string'],
        ]);

        $staff = Staff::where('id', $id)->firstOrFail();
    
        $staff->position = $request->input('position');
        $staff->shortcode = $request->input('shortcode');
        $staff->email = $request->input('email');
        $staff->description = $request->input('description');
        $staff->save();

        activity()
            ->performedOn($staff)
            ->withProperties([
                'position' => $request->input('position'),
                'shortcode' => $request->input('shortcode'),
                'description' => $request->input('description'),
                'email' => $request->input('email'),
            ])->log('Updated staff position '.$staff->position);

        return redirect()->route('dashboard.staff.show', ['id' => $staff->id])->with('success', 'La posición '.$staff->position.' ha sido actualizada con éxito');
    }

    public function link(Request $request, int $id)
    {
        if ($request->input('user') == null) {
            return redirect()->route('dashboard.staff.show', ['id' => $id])->with('error', 'El formulario de usuario no puede estar vació!');
        }

        $staff = Staff::where('id', $id)->firstOrFail();
        $user = User::where('cid', explode(' ', $request->input('user'))[0])->first();

        if (! $user) {
            return redirect()->route('dashboard.staff.show', ['id' => $id])->with('error', 'No se encontro el usuario a asignar!');
        }

        // Si la posición ya tenia un usuario borrarlo
        if ($staff->user) {
            $staff->user()->dissociate();
            $staff->save();
        }

        if ($user->staff) {
            $user->staff->user()->dissociate();
            $user->staff->save();
        }

        $staff->user()->associate($user);
        $staff->save();

        activity()
            ->performedOn($user)
            ->log('Assigned staff position '.$staff->position.' to '.$user->name.' - '.$user->cid);

        return redirect()->route('dashboard.staff.show', ['id' => $staff->id])->with('success', 'Se asigó '.$user->name.' con exito a la posición '.$staff->position);
    }

    public function unlink(Request $request, int $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $staffID = $user->staff->id;

        $user->staff->user()->dissociate();
        $user->staff->save();

        activity()
            ->performedOn($user)
            ->log('Removed staff position '.$user->staff->position.' from '.$user->name.' - '.$user->cid);

        return redirect()->route('dashboard.staff.show', ['id' => $staffID])->with('success', 'Se desviculó el usuario de esta posición!');
    }

    public function destroy(int $id)
    {
        $staff = Staff::where('id', $id)->firstOrFail();
        $staff->delete();

        activity()
            ->performedOn($staff)
            ->log('Deleted staff position '.$staff->position);

        return redirect()->route('dashboard.staff.index')->with('success', 'Se borro la posición con éxito!');
    }
}
