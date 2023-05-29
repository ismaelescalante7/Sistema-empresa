<?php

namespace App\Http\Controllers;

use App\Helpers\TemporaryPassword;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UserSearchRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function store(
        UserStoreRequest $request,
        TemporaryPassword $temporaryPassword
    ): RedirectResponse {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $temporaryPassword()
        ]);

        //Notification::send($user, $userCreatedNotification);

        return Redirect::route('users.index');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Update', [
            'user' => $user
        ]);
    }

    public function update(
        UserUpdateRequest $request,
        User $user
    ): RedirectResponse {
        $data = $request->validated();
        $user->update([
            'name' => $data['name']
        ]);
        return Redirect::route('users.index');
    }

    public function uploadImage(User $user, UpdateImageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $image_path = $data['image']->store('profiles', 'profiles');
            $user->update(['profile_photo_path' => $image_path]);
        } else {
            if (Storage::disk('profiles')->exists($user->profile_photo_path)) {
                Storage::disk('profiles')->delete($user->profile_photo_path);
            }
            $user->update(['profile_photo_path' => config('custom.profile_default.nombre')]);
        }
        return Redirect::route('profile.show');
    }
}
