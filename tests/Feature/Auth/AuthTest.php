<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_log_in()
    {
        $user = $this->generateUser();

        $response = $this->postJson(route('auth.login', [
            'email' => $user->email,
            'password' => $user->password
        ]));
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email'
            ],
            'token'
        ]);
    }
    public function test_user_cannot_login_if_email_is_incorrect()
    {
        $user = $this->generateUser();

        $response = $this->postJson(route('auth.login', [
            'email' => 'test1@email.com',
            'password' => $user->password,
        ]));

        $response->assertUnauthorized();
    }

    public function test_user_cannot_login_if_password_is_incorrect()
    {
        $user = $this->generateUser();

        $response = $this->postJson(route('auth.login', [
            'email' => $user->email,
            'password' => 'password'
        ]));
        $response->assertUnauthorized();
    }

    public function test_login_validation_email_is_required()
    {
        $user = $this->generateUser();

        $response = $this->postJson(route('auth.login', [
            'email' => '',
            'password' => $user->password
        ]));
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_login_validation_password_is_required()
    {
        $user = $this->generateUser();

        $response = $this->postJson(route('auth.login', [
            'email' => $user->email,
            'password' => ''
        ]));

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['password']);
    }

    public function test_user_is_logged_out()
    {
        $user = $this->generateUser();

        $response = $this->actingAs($user)->postJson(route('auth.logout'));
        $response->assertOk();
    }
}
