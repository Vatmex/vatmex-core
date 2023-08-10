<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::all();

        return view('dashboard.instructors.index', compact('instructors'));
    }

    public function show(int $id)
    {
        $instructor = Instructor::where('id', $id)->first();

        return view('dashboard.instructors.show', compact('instructor'));
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

        return redirect()->route('dashboard.instructors.show', ['id' => $id])->with('success', 'Se editaron las habilitaciones del CTA con éxito!');
    }

    public function destroy(int $id)
    {
        $instructor = Instructor::where('id', $id)->first();
        $instructor->delete();

        return redirect()->route('dashboard.instructors.index')->with('success', '¡Adios popó! Se borro el instructor con éxito!');;
    }
}
