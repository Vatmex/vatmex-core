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

        return view('dashboard.students.show', compact('student'));
    }

    public function remove(int $cid)
    {
        $student = User::where('cid', $cid)->first()->atc;
        $student->is_training = false;
        $student->save();

        return redirect()->route('dashboard.students.index')->with('success', 'El entrenamienot de '.$student->user->name.' fue detenido con éxito!');
    }
}
