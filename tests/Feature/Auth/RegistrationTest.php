<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_register()
    {
        $user = $this->createUser();

        $this->postJson(route('auth.register', $user))
            ->assertCreated();

        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }

    public function test_validation_for_required_email()
    {
        $user = $this->createUser();

        $user['email'] = null;
        $response = $this->postJson(route('auth.register', $user))
            ->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_validation_for_unique_email()
    {
        $user = $this->createUser();
        $this->postJson(route('auth.register', $user))
            ->assertCreated();


        $response = $this->postJson(route('auth.register', [
            'name' => "Test Name",
            'email' => $user['email'],
            'password' => 'password',
            'password_confirmation' => 'password'
        ]))
            ->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_validation_for_required_name()
    {
        $user = $this->createUser();
        $user['name'] = null;

        $response = $this->postJson(route('auth.register', $user))
            ->assertUnprocessable();
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_validation_for_required_password()
    {
        $user = $this->createUser();
        $user['password'] = null;

        $response = $this->postJson(route('auth.register', $user))
            ->assertUnprocessable();
        $response->assertJsonValidationErrors(['password']);
    }

    public function test_validation_for_password_confirmation()
    {
        $user = $this->createUser();
        $user['password_confirmation'] = 'test_password';

        $response = $this->postJson(route('auth.register', $user))
            ->assertUnprocessable();
        $response->assertJsonValidationErrors(['password']);
    }
}
