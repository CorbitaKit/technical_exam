<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Hash;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function doLogin(array $credentials): object
    {
        $user = $this->authRepository->findByEmail($credentials);

        if (!$user || Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'user' => $user->only('id', 'name', 'email'),
            'token' => $user->createToken('api_token')->plainTextToken,
        ]);
    }
}
