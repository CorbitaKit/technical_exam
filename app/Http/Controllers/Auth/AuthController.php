<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');
        return $this->authService->doLogin($credentials);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
    }
}
