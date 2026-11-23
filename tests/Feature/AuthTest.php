<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_can_register(): void
    {
        $this->post('/register', [
            'name' => 'Sam',
            'email' => 'sam@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect('/');

        $this->assertAuthenticated();
        $this->assertFalse(User::where('email', 'sam@example.com')->first()->is_admin);
    }

    public function test_login_with_a_wrong_password_fails(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_guests_are_sent_to_the_login_page(): void
    {
        $this->get('/workouts')->assertRedirect('/login');
        $this->get('/favourites')->assertRedirect('/login');
    }
}
