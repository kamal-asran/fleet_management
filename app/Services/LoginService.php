<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login(string $email, string $password): bool
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        return Auth::attempt($credentials);
    }
}
