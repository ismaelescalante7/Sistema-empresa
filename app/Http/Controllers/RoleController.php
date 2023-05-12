<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['name', 'description']);
        $roles = Role::where('name', 'like', "%{$request->get('name')}%")
            ->where('description', 'like', "%{$request->get('description')}%")
            ->orderBy('name')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('Roles/List', compact('roles', 'filters'));
    }

    public function create(): Response
    {
        return Inertia::render('Roles/Create');
    }

    public function store(
        RoleStoreRequest $request
    ): RedirectResponse {
        Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return Redirect::route('roles.index');
    }

    public function edit(Role $role): Response
    {
        return Inertia::render('Roles/Update', [
            'role' => $role,
        ]);
    }

    public function update(
        RoleUpdateRequest $request,
        Role $role
    ): RedirectResponse {
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();
        return Redirect::route('roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return Redirect::route('roles.index');
    }
}
