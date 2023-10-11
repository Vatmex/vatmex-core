<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function index()
    {
        $student = \Auth::user()->atc;
        $instructor = \Auth::user()->atc->instructor;

        return view('my.index', compact('student', 'instructor'));
    }
}
