<?php

namespace App\Http\Controllers;

use App\Mail\ATCSuspensionMail;
use App\Models\ATC;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ATCController extends Controller
{
    public function index()
    {
        $atcs = ATC::all();

        return view('dashboard.atc.index', compact('atcs'));
    }

    public function show(int $cid)
    {
        $atc = User::where('cid', $cid)->firstOrFail()->atc;
        $instructors = Instructor::all();

        return view('dashboard.atc.show', compact('atc', 'instructors'));
    }

    public function edit(int $cid)
    {
        $atc = User::where('cid', $cid)->firstOrFail()->atc;

        return view('dashboard.atc.edit', compact('atc'));
    }

    public function update(Request $request, int $cid)
    {
        $atc = User::where('cid', $cid)->firstOrFail()->atc;

        $request->validate([
            'name' => ['required', 'string'],
            'initials' => ['required', 'string', 'min:2', 'max:2', Rule::unique('atcs')->ignore($atc->id, 'id')],
        ]);

        $atc->user->name = $request->get('name');
        $atc->initials = $request->get('initials');
        $atc->delivery = $request->has('delivery');
        $atc->ground = $request->has('ground');
        $atc->tower = $request->has('tower');
        $atc->approach = $request->has('approach');
        $atc->center = $request->has('center');
        $atc->user->save();
        $atc->save();

        activity()
            ->performedOn($atc)
            ->withProperties([
                'name' => $request->get('name'),
                'initials' => $request->get('initials'),
                'delivery' => $request->has('delivery'),
                'ground' => $request->has('ground'),
                'tower' => $request->has('tower'),
                'approach' => $request->has('approach'),
                'center'=> $request->has('center'),
            ])->log('Updated ATC profile for '.$atc->user->name.' - '.$atc->user->cid);

        return redirect()->route('dashboard.atcs.show', ['cid' => $cid])->with('success', 'Se editaron las habilitaciones del CTA con éxito!');
    }

    public function activate(int $cid)
    {
        $atc = User::where('cid', $cid)->firstOrFail()->atc;

        $atc->inactive = false;
        $atc->save();

        activity()
            ->performedOn($atc)
            ->log('Set ATC Status to active for '.$atc->user->name.' - '.$atc->user->cid);

        return redirect()->route('dashboard.atcs.show', ['cid' => $cid])->with('success', 'Se activo al CTA con éxito!');
    }

    public function deactivate(int $cid)
    {
        $atc = User::where('cid', $cid)->firstOrFail()->atc;

        $atc->inactive = true;
        $atc->save();

        activity()
            ->performedOn($atc)
            ->log('Set ATC Status to inactive for '.$atc->user->name.' - '.$atc->user->cid);

        try {
            Mail::to($atc->user->email)->send(new ATCSuspensionMail($atc));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.atcs.show', ['cid' => $cid])->with('success', 'Se desactivo al CTA con éxito! Sin embargo no se pudo enviar el mail de notificación. Favor de notificar manualmente.');
        }

        return redirect()->route('dashboard.atcs.show', ['cid' => $cid])->with('success', 'Se desactivo al CTA con éxito!');
    }
}
