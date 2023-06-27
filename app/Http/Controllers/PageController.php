<?php

namespace App\Http\Controllers;

use App\Models\ATC;
use App\Models\Category;
use App\Models\Event;
use App\Models\Team;

class PageController extends Controller
{
    public function home()
    {
        $events = Event::latest()->take(3)->get();
        $team = Team::where('name', 'Dirección')->first();

        return view('pages.home', compact('events', 'team'));
    }

    public function about_staff()
    {
        $teams = Team::all();

        return view('about.staff', compact('teams'));
    }

    public function about_roster()
    {
        $atcs = ATC::all();

        return view('about.roster', compact('atcs'));
    }

    public function pilots_feedback()
    {
        $atcs = ATC::all();

        return view('pilots.feedback', compact('atcs'));
    }

    public function atc_documents()
    {
        $categories = Category::all();

        return view('about.documents', compact('categories'));
    }
}
