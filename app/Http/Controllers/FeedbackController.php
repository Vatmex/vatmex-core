<?php

namespace App\Http\Controllers;

use App\Models\ATC;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();

        return view('dashboard.feedbacks.index', compact('feedbacks'));
    }

    public function show(int $id)
    {
        $feedback = Feedback::where('id', $id)->firstOrFail();

        return view('dashboard.feedbacks.show', compact('feedback'));
    }

    public function store(Request $request)
    {
        $controller = ATC::where('id', $request->input('controller_id'))->firstOrFail();

        $feedback = new Feedback;
        $feedback->name = $request->input('name');
        $feedback->cid = $request->input('cid');
        $feedback->email = $request->input('email');
        $feedback->rating = $request->input('rating');
        $feedback->position = $request->input('position');
        $feedback->message = $request->input('message');

        $controller = $controller->feedbacks()->save($feedback);

        // TODO: Implement Feedback email

        return redirect()->route('home')->with('success', 'Tu feedback ha sido registrado con éxito! En caso de ser necesario nos pondremos en contacto contigo.');
    }
}
