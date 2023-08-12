<?php

namespace App\Http\Controllers;

use App\Models\ATC;
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
        return 'show';
    }

    public function edit(int $cid)
    {
        return 'edit';
    }
    
    public function store(Request $request, int $cid)
    {
        return 'store';
    }
}
