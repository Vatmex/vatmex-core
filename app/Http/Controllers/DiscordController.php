<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function callback()
    {
        $user = Auth::user();
        $discord = Socialite::driver('discord')->user();

        $user->discord_id = $discord->id;
        $user->discord_name = $discord->name;
        $user->discord_avatar = $discord->avatar;
        $user->save();

        return redirect()->route('my.index')->with('success', 'Se vinculó la cuenta de Discord con éxito');
    }

    public function unlink()
    {
        $user = Auth::user();

        $user->discord_id = null;
        $user->discord_name = null;
        $user->discord_avatar = null;
        $user->save();

        return redirect()->route('my.index')->with('success', 'Se desvinculó la cuenta de Discord con Éxito');
    }
}
