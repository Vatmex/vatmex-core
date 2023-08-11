<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('dashboard.users.index', compact('users'));
    }

    public function show(int $cid)
    {
        $user = User::where('cid', $cid)->first();
        $roles = Role::all()->where('name', '!=', 'Super-Admin'); // Super-Admin cannot be assigned. THERE CAN ONLY BE ONE!

        // Vatsim data for the user
        if (App::environment() == 'local') {
            $request = Http::get('https://api.vatsim.net/api/ratings/1303345/');
        } else {
            $request = Http::get('https://api.vatsim.net/api/ratings/'.$cid.'/');
        }
        $vatsim = $request->json();

        return view('dashboard.users.show', compact('user', 'roles', 'vatsim'));
    }
}
