<?php

namespace App\Http\Controllers;

use App\Models\TrainingNote;
use App\Models\User;
use Illuminate\Http\Request;

class TrainingNoteController extends Controller
{
    public function show(int $id)
    {
        $note = TrainingNote::where('id', $id)->first();

        return view('dashboard.trainingNotes.show', compact('note'));
    }

    public function create(int $cid)
    {
        $student = User::where('cid', $cid)->first()->atc;

        return view('dashboard.trainingNotes.create', compact('student'));
    }

    public function store(Request $request, int $cid)
    {
        $request->validate([
            'message' => ['required', 'string'],
        ]);

        $student = User::where('cid', $cid)->first()->atc;

        $trainingNote = new TrainingNote;
        $trainingNote->created_by = \Auth::user()->cid;
        $trainingNote->message = $request->input('message');
        $trainingNote->visible_to_student = $request->has('visible');

        $student->notes()->save($trainingNote);

        return redirect()->route('dashboard.students.show', ['cid' => $student->user->cid])->with('success', 'Se agregó la nota con éxito!');
    }

    public function edit(int $id)
    {
        $note = TrainingNote::where('id', $id)->first();

        return view('dashboard.trainingNotes.edit', compact('note'));
    }

    public function update(Request $request, int $id)
    {
        $note = TrainingNote::where('id', $id)->first();

        if ($note->created_by != \Auth::user()->cid) {
            return redirect()->route('dashboard.trainingNotes.show', ['id' => $id])->with('error', 'No puedes editar notas creadas por otros!');
        }

        $note->message = $request->input('message');
        $note->save();

        return redirect()->route('dashboard.trainingNotes.show', ['id' => $id])->with('success', 'Nota editada con éxito!');
    }

    public function destroy(int $id)
    {
        $note = TrainingNote::where('id', $id)->first();
        $studentCid = $note->student->user->cid;

        if ($note->created_by != \Auth::user()->cid) {
            return redirect()->route('dashboard.trainingNotes.show', ['id' => $id])->with('error', 'No puedes eliminar notas creadas por otros!');
        }

        $note->delete();

        return redirect()->route('dashboard.students.show', ['cid' => $studentCid])->with('success', 'Nota eliminada con éxito!');

    }
}
