<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(Role $role): Response
    {
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if ($role->hasDirectPermission($permission->name)) {
                $permission->status = "SI";
            } else {
                $permission->status = "NO";
            }
        }
        return Inertia::render('Permissions/List', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function edit(Role $role): Response
    {
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if ($role->hasDirectPermission($permission->name)) {
                $permission->status = "SI";
            } else {
                $permission->status = "NO";
            }
        }
        return Inertia::render('Permissions/Update', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        foreach ($request['permissions'] as $permission) {
            if ($permission['status'] === 'SI') {
                $role->givePermissionTo($permission['name']);
            } else {
                $role->revokePermissionTo($permission['name']);
            }
        }
        return Redirect::route('roles.permissions.index', compact('role'));
    }
}
