<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * AuthController
 *
 * Manages all functions related to authentication and integration
 * with Vatsim Connect
 *
 * @author Gustavo Valdez <gvaldezsan@gmail.com>
 */
class AuthController extends Controller
{
    /**
     * Returns a redirect to Vatsim's OATH server with the correct
     * parameters for the scope and authentication.
     *
     * @return Response
     */
    public function redirect()
    {
        if (! session()->has('url.intended')) {
            // Save the intended URL in the session for a future redirect
            session()->put('url.intended', url()->previous());
        }

        return Socialite::driver('vatsim')->requiredScopes(['full_name', 'email', 'vatsim_details'])->redirect();
    }

    /**
     * Callback function for Vatsim Connect's OATH2 implementation.
     * Validates if the user already exists, otherwise a new one is
     * registered.
     *
     * NOTE: This function validates new and old users using CID not
     * the internal DB id.
     *
     * @return Response
     */
    public function callback()
    {
        $intendedUrl = session('url.intended');
        session()->forget('url.intended');

        try {
            $vatsimUser = Socialite::driver('vatsim')->user();
        } catch (Laravel\Socialite\Two\InvalidStateException $e) {
            return redirect()->route('home')->with('error', 'El inicio de sesión ha expirado. Por favor intenta de nuevo');
        }

        $user = User::where('cid', $vatsimUser->id)->first();

        if ($user) {
            // If user exists logins
            Auth::login($user);
        } else {
            // Else register and then login
            $newUser = User::create([
                'name' => $vatsimUser->name,
                'email' => strtolower(trim($vatsimUser->email)),
                'cid' => $vatsimUser->user['data']['cid'],
                'first_name' => $vatsimUser->user['data']['personal']['name_first'],
                'last_name' => $vatsimUser->user['data']['personal']['name_last'],
            ]);

            Auth::login($newUser);
        }

        return redirect()->intended($intendedUrl);
    }

    /**
     * Logs the current user out and redirects home.
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
