<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use App\Models\Store;
use Hash;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function generateUser(): object
    {
        return User::factory()->create([
            "email" => "test@email.com",
            "password" => 'password'
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

    public function generateStore(int $user_id, int $count): object
    {
        return Store::factory()->count($count)->create(['user_id' => $user_id]);
    }

    public function createStore(int $user_id): array
    {
        return [
            'name' => 'Test Name',
            'address' => 'Test Address',
            'user_id' => $user_id
        ];
    }
}
