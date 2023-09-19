<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\RegistrationService;
use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function __invoke(RegistrationRequest $request)
    {
        return $this->registrationService->register($request->only('email', 'password', 'name'));
    }
}
