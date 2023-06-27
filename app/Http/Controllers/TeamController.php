<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();

        return view('dashboard.teams.index', compact('teams'));
    }

    public function show($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $staffs = Staff::all();

        return view('dashboard.teams.show', compact('team', 'staffs'));
    }

    public function create()
    {
        return view('dashboard.teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $team = new Team;
        $team->name = $request->input('name');
        $team->description = $request->input('description');

        try {
            $team->save();
        } catch (Exception $e) {
            return redirect('/ops/site/teams/new')->with('error', 'No se pudo crear el equipo. Error desconocido');
        }

        return redirect('/ops/site/teams/'.$team->id)->with('success', 'Equipo creado exitosamente!');
    }

    public function edit($id)
    {
        $team = Team::where('id', $id)->firstOrFail();

        return view('dashboard.teams.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::where('id', $id)->firstOrFail();

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $team->name = $request->input('name');
        $team->description = $request->input('description');

        $team->save();

        return redirect('/ops/site/teams/'.$team->id)->with('success', 'Equipo actualizado con éxito');
    }

    public function link(Request $request, $id)
    {
        if ($request->role == null) { // TODO: Check if this is correct
            return redirect('/ops/site/teams/'.$id)->with('error', 'Es necesario seleccionar un posición de staff!');
        }

        $team = Team::where('id', $id)->first();
        $staff = Staff::where('position', $request->input('role'))->first();

        if (! $staff) {
            return redirect('/ops/site/teams/'.$id)->with('error', 'No se encontro esa posición de staff!');
        }

        // If staff already assigned to a team, unassign first.
        if ($staff->team) {
            $staff->team()->dissociate();
            $staff->save();
        }

        $staff->team()->associate($team);
        $staff->save();

        return redirect('/ops/site/teams/'.$id)->with('success', 'Posición de staff asignada con éxito!');
    }

    public function unlink($id)
    {
        $staff = Staff::where('id', $id)->firstOrFail();
        $teamID = $staff->team->id;

        $staff->team()->dissociate();
        $staff->save();

        return redirect('/ops/site/teams/'.$teamID)->with('success', 'Posición de staff asignada con éxito!');
    }

    public function destroy($id)
    {
        $team = Team::where('id', $id)->first();

        if ($team) {
            $team->delete();

            return redirect('ops/site/teams')->with('success', 'Se elimino el equipo '.$team->name);
        }

        return redirect('ops/site/teams')->with('error', 'No se pudo borrar el equipo');
    }
}
