<?php

namespace App\Repositories\Auth;

use App\Models\User;

class RegistrationRepository
{
    public function create(array $userData): object
    {
        return User::create($userData);
    }
}
