<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_api_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'username' => 'Test User',
            'password' => 'password',
            'password_confirmation' => 'password',
            'is_active' => true,
            'role' => 'manager'
        ]);

    
        $this->assertAuthenticated();
        $response->assertStatus(200);
    }
}
