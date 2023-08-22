<?php

namespace App\Http\Controllers;

use App\Models\ATC;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = ATC::all()->where('is_training', '==', true);

        return view('dashboard.students.index', compact('students'));
    }

    public function show(int $cid)
    {
        $student = User::where('cid', $cid)->first()->atc;

        if (! $student->is_training) {
            return redirect()->route('dashboard.students.index')->with('error', 'El controlador no es un estudiante activo');
        }

        return view('dashboard.students.show', compact('student'));
    }

    public function assign(Request $request, int $cid)
    {
        $student = User::where('cid', $cid)->first()->atc;
        $instructor = User::where('cid', explode(' ', $request->instructor)[0])->first()->instructor_profile;

        $student->is_training = true;
        $instructor->atcs()->save($student);

        activity()
            ->performedOn($student)
            ->log('Assigned student '.$student->user->name.' - '.$student->user->cid.' to instructor '.$instructor->user->name.' - '.$instructor->user->cid);

        return redirect()->route('dashboard.students.show', ['cid' => $student->user->cid])->with('success', 'Instructor asingado con éxito!');
    }

    public function remove(int $cid)
    {
        $student = User::where('cid', $cid)->first()->atc;
        $student->is_training = false;
        $student->save();

        activity()
            ->performedOn($student)
            ->log('Removed student '.$student->user->name.' - '.$student->user->cid.' from instructor '.$student->instructor->user->name.' - '.$student->instructor->user->cid);

        return redirect()->route('dashboard.students.index')->with('success', 'El entrenamienot de '.$student->user->name.' fue detenido con éxito!');
    }
}
