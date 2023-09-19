<?php

namespace App\Repositories\Auth;
use App\Models\User;
class AuthRepository
{
    public function findByEmail($credentials)
    {
        return User::whereEmail($credentials['email'])->first();
    }
}