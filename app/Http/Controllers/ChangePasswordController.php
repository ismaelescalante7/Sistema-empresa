<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm(): Response
    {
        return Inertia::render('Profile/ChangePassword');
    }

}