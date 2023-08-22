<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::all();

        return view('dashboard.instructors.index', compact('instructors'));
    }

    public function show($id)
    {
        $instructor = Instructor::where('id', $id)->first();

        return view('dashboard.instructors.show', compact('instructor'));
    }

    public function store(int $cid)
    {
        $user = User::where('cid', $cid)->first();

        $instructor = new Instructor;
        $instructor->tower = true;
        $instructor->approach = false;
        $instructor->center = false;
        $instructor->oceanic = false;
        $instructor->management = false;

        $user->instructor_profile()->save($instructor);
        $user->assignRole('instructor');
        $user->save();

        activity()
            ->performedOn($instructor)
            ->log('Promoted '.$user->name.' - '.$user->cid.' to instructor');

        return redirect()->route('dashboard.instructors.show', ['id' => $instructor->id])->with('success', 'Instructor creado con éxito');
    }

    public function edit(int $id)
    {
        $instructor = Instructor::where('id', $id)->first();

        return view('dashboard.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, int $id)
    {
        $instructor = Instructor::where('id', $id)->first();

        $instructor->tower = $request->has('tower');
        $instructor->approach = $request->has('approach');
        $instructor->center = $request->has('center');
        $instructor->save();

        activity()
            ->performedOn($instructor)
            ->withProperties([
                'tower' => $request->has('tower'),
                'approach' => $request->has('approach'),
                'center' => $request->has('center'),
            ])->log('Updated instructor ratings for '.$instructor->user->name.' - '.$instructor->user->cid);

        return redirect()->route('dashboard.instructors.show', ['id' => $id])->with('success', 'Se editaron las habilitaciones del CTA con éxito!');
    }

    public function destroy(int $id)
    {
        $instructor = Instructor::where('id', $id)->first();
        $instructor->user->removeRole('instructor');
        $instructor->delete();

        activity()
            ->performedOn($instructor)
            ->log('Demoted '.$instructor->user->name.' - '.$instructor->user->cid.' from instructor');

        return redirect()->route('dashboard.instructors.index')->with('success', '¡Adios popó! Se borro el instructor con éxito!');
    }
}
