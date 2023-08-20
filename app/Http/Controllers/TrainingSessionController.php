<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    public function show(int $id)
    {
        $session = TrainingSession::where('id', $id)->first();

        return view('dashboard.trainingSessions.show', compact('session'));
    }

    public function create(int $cid)
    {
        $student = User::where('cid', $cid)->first()->atc;

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

        $trainingSession = new TrainingSession;
        $trainingSession->title = $request->input('title');
        $trainingSession->created_by = \Auth::user()->cid;
        $trainingSession->scheduled_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('scheduled_time'), 'America/Mexico_City')->setTimezone('UTC');
        $trainingSession->description = $request->input('description');

        $student->notes()->save($trainingSession);

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

        $trainingSession = TrainingSession::where('id', $id)->first();
        $trainingSession->title = $request->input('title');
        $trainingSession->scheduled_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('scheduled_time'), 'America/Mexico_City')->setTimezone('UTC');
        $trainingSession->description = $request->input('description');

        $trainingSession->save();

        return redirect()->route('dashboard.students.show', ['cid' => $trainingSession->student->user->cid])->with('success', 'Sesión de entrenamiento actualizada con éxito');
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

        return redirect()->route('dashboard.students.show', ['cid' => $session->student->user->cid])->with('success', 'Sesión de entrenamiento cancelada con éxito');
    }
}
