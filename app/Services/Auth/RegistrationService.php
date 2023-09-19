<?php

namespace App\Services\Auth;

use App\Repositories\Auth\RegistrationRepository;
use Hash;

class RegistrationService
{
    protected $registrationRepo;
    public function __construct(RegistrationRepository $registrationRepo)
    {
        $this->registrationRepo = $registrationRepo;
    }
    public function register(array $userData): object
    {
        $userData['password'] = Hash::make($userData['password']);
        return $this->registrationRepo->create($userData);
    }
}
