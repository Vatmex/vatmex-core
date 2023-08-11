<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function assign(Request $request, int $cid)
    {
        // Don't allow assign of admin roles. That shit has to be assigned manually to be extra sure.
        if ($request->get('role') == 'Super-Admin' || $request->get('role') == 'administrator') {
            return redirect()->route('dashboard.users.show', ['cid' => $cid])->with('error', 'No se puede asignar roles de admin desde la interfaz web. Si consideras que es necesario, contacta al administrador');
        }

        $role = Role::where('name', $request->get('role'))->first();
        $user = User::where('cid', $cid)->first();

        $user->assignRole($role);

        return redirect()->route('dashboard.users.show', ['cid' => $cid])->with('success', 'Rol asignado con éxito!');
    }

    public function remove(int $cid, string $role)
    {
        // Don't allow removal of admin roles. That shit has to be removed manually to be extra sure.
        if ($role == 'Super-Admin' || $role == 'administrator') {
            return redirect()->route('dashboard.users.show', ['cid' => $cid])->with('error', 'No se puede remover roles de admin desde la interfaz web. Si consideras que es necesario, contacta al administrador');
        }

        $role = Role::where('name', $role)->first();
        $user = User::where('cid', $cid)->first();

        $user->removeRole($role);

        return redirect()->route('dashboard.users.show', ['cid' => $cid])->with('success', 'Rol removido con éxito!');
    }
}
