<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function siteIndex()
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    public function dashboardIndex()
    {
        $events = Event::all();

        return view('dashboard.events.index', compact('events'));
    }

    public function siteShow($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $previousEvent = Event::where('start', '<', $event->start)->first();
        $nextEvent = Event::where('start', '>', $event->start)->first();

        return view('events.show', compact('event', 'previousEvent', 'nextEvent'));
    }

    public function create()
    {
        return view('dashboard.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'departure_airfields' => ['nullable', 'string'],
            'arrival_airfields' => ['nullable', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'banner' => ['required', 'mimes:jpg,jpeg,png', 'max:20480'],
            'slug' => ['required', 'unique:events', 'lowercase', 'alpha-dash'],
        ]);

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('event-banners', 'public');
        }

        $event = Event::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'departure_airfields' => $request->input('departure_airfields'),
            'arrival_airfields' => $request->input('arrival_airfields'),
            'banner_path' => $bannerPath,
            'hidden' => $request->has('hidden'),
            'slug' => $request->input('slug'),
        ]);

        activity()
            ->performedOn($event)
            ->withProperties([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'departure_airfields' => $request->input('departure_airfields'),
                'arrival_airfields' => $request->input('arrival_airfields'),
                'banner_path' => $bannerPath,
                'hidden' => $request->has('hidden'),
                'slug' => $request->input('slug'),
            ])->log('Created event '.$event->name);

        return redirect('/ops/events/'.$event->slug)->with('success', 'El evento ha sido creado con éxito!');
    }

    public function edit(string $slug)
    {
        if (\Auth::user()->hasPermissionTo('view trashed')) {
            $event = Event::withTrashed()->where('slug', $slug)->firstOrFail();

            if($event->trashed()) {
                \Session::flash('error','Estas viendo un registro que fue borrado. Esta almacenado para motivos de auditoría y solo puede ser visto por administradores.');
            }
        }
        else {
            $event = Event::where('slug', $slug)->firstOrFail();
        }

        return view('dashboard.events.edit', compact('event'));
    }

    public function update(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'departure_airfields' => ['nullable', 'string'],
            'arrival_airfields' => ['nullable', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'banner' => ['mimes:jpg,jpeg,png', 'max:20480'],
            'slug' => ['required',
                'lowercase',
                'alpha-dash',
                Rule::unique('events', 'slug')->ignore($event->slug, 'slug')],
        ]);

        // Check for a new banner, otherwise use the old one.
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('event-banners', 'public');
        } else {
            $bannerPath = $event->banner_path;
        }

        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->departure_airfields = $request->input('departure_airfields');
        $event->arrival_airfields = $request->input('arrival_airfields');
        $event->banner_path = $bannerPath;
        $event->hidden = $request->has('hidden');
        $event->slug = $request->input('slug');

        $event->save();

        activity()
            ->performedOn($event)
            ->withProperties([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'departure_airfields' => $request->input('departure_airfields'),
                'arrival_airfields' => $request->input('arrival_airfields'),
                'banner_path' => $bannerPath,
                'hidden' => $request->has('hidden'),
                'slug' => $request->input('slug'),
            ])->log('Updated event '.$event->name);

        return redirect('/ops/events/'.$event->slug)->with('success', 'El evento fue actualizado con éxito!');
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)->first();

        if ($event) {
            $event->delete();

            activity()
                ->performedOn($event)
                ->log('Deleted event '.$event->name);

            return redirect('ops/events')->with('success', 'Se elimino el evento '.$event->name);
        }

        return redirect('ops/events/')->with('error', 'No se pudo borrar el evento');
    }
}
