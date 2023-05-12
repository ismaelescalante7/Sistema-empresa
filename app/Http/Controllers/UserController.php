<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSearchRequest;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(UserSearchRequest $request): Response
    {
        $filters = $request->only(['name']);
        $users = User::mainSearch(collect($filters))
            ->orderBy('name')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('Users/List', [
            'users' => $users,
            'filters' => $filters
        ]);
    }
}
