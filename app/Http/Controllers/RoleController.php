<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('dashboard.roles.index', compact('roles'));
    }

    public function show(int $id)
    {
        $role = Role::where('id', $id)->firstOrFail();

        return view('dashboard.roles.show', compact('role'));
    }

    public function edit(int $id)
    {
        $role = Role::where('id', $id)->firstOrFail();

        return view('dashboard.roles.edit', compact('role'));
    }

    public function update(Request $request, int $id)
    {
        $role = Role::where('id', $id)->firstOrFail();

        $permissions = [];

        if ($request->has('view_users')) {
            array_push($permissions, 'view users');
        }

        if ($request->has('view_roles')) {
            array_push($permissions, 'view roles');
        }
        if ($request->has('create_roles')) {
            array_push($permissions, 'create roles');
        }
        if ($request->has('edit_roles')) {
            array_push($permissions, 'edit roles');
        }
        if ($request->has('assign_roles')) {
            array_push($permissions, 'assign roles');
        }
        if ($request->has('remove_roles')) {
            array_push($permissions, 'remove roles');
        }
        if ($request->has('delete_roles')) {
            array_push($permissions, 'delete roles');
        }

        if ($request->has('view_staff')) {
            array_push($permissions, 'view staff');
        }
        if ($request->has('create_staff')) {
            array_push($permissions, 'create staff');
        }
        if ($request->has('edit_staff')) {
            array_push($permissions, 'edit staff');
        }
        if ($request->has('assign_staff')) {
            array_push($permissions, 'assign staff');
        }
        if ($request->has('delete_staff')) {
            array_push($permissions, 'delete staff');
        }

        if ($request->has('view_documents')) {
            array_push($permissions, 'view documents');
        }
        if ($request->has('create_documents')) {
            array_push($permissions, 'create documents');
        }
        if ($request->has('edit_documents')) {
            array_push($permissions, 'edit documents');
        }
        if ($request->has('delete_documents')) {
            array_push($permissions, 'delete documents');
        }

        if ($request->has('view_applications')) {
            array_push($permissions, 'view applications');
        }
        if ($request->has('assign_applications')) {
            array_push($permissions, 'assign applications');
        }

        if ($request->has('view_instructors')) {
            array_push($permissions, 'view instructors');
        }
        if ($request->has('create_instructors')) {
            array_push($permissions, 'create instructors');
        }
        if ($request->has('edit_instructors')) {
            array_push($permissions, 'edit instructors');
        }
        if ($request->has('delete_instructors')) {
            array_push($permissions, 'delete instructors');
        }

        if ($request->has('view_students')) {
            array_push($permissions, 'view students');
        }
        if ($request->has('edit_students')) {
            array_push($permissions, 'edit students');
        }
        if ($request->has('assign_students')) {
            array_push($permissions, 'assign students');
        }
        if ($request->has('remove_students')) {
            array_push($permissions, 'remove students');
        }

        if ($request->has('view_atcs')) {
            array_push($permissions, 'view atcs');
        }
        if ($request->has('edit_atcs')) {
            array_push($permissions, 'edit atcs');
        }

        if ($request->has('view_events')) {
            array_push($permissions, 'view events');
        }
        if ($request->has('create_events')) {
            array_push($permissions, 'create events');
        }
        if ($request->has('edit_events')) {
            array_push($permissions, 'edit events');
        }
        if ($request->has('delete_events')) {
            array_push($permissions, 'delete events');
        }

        if ($request->has('view_logs')) {
            array_push($permissions, 'view logs');
        }
        if ($request->has('view_records')) {
            array_push($permissions, 'view records');
        }

        $role->syncPermissions($permissions);

        return redirect()->route('dashboard.roles.show', ['id' => $role->id])->with('success', 'Permisos de Rol editados con éxito!');
    }

    public function assign(Request $request, int $cid)
    {
        // Don't allow assign of admin roles. That shit has to be assigned manually to be extra sure.
        if ($request->get('role') == 'Super-Admin' || $request->get('role') == 'administrator') {
            return redirect()->route('dashboard.users.show', ['cid' => $cid])->with('error', 'No se puede asignar roles de admin desde la interfaz web. Si consideras que es necesario, contacta al administrador');
        }

        $role = Role::where('name', $request->get('role'))->first();
        $user = User::where('cid', $cid)->first();

        $user->assignRole($role);

        activity()
            ->performedOn($user)
            ->log('Assigned website role '.$role->name.' to '.$user->name.' - '.$user->cid);

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

        activity()
            ->performedOn($user)
            ->log('Removed website role '.$role->name.' to '.$user->name.' - '.$user->cid);

        return redirect()->route('dashboard.users.show', ['cid' => $cid])->with('success', 'Rol removido con éxito!');
    }
}
