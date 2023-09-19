<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use Hash;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function generateUser(): object
    {
        return User::factory()->create([
            "email" => "test@email.com",
            "password" => Hash::make("password")
        ]);
    }

    public function authUser(): object
    {
        $user = $this->generateUser();
        Sanctum::actingAs($user);
        return $user;
    }

    public function createUser(): array
    {
        return [
            'email' => 'test@email.com',
            'name' => "Test User",
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
    }
}
