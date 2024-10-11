<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_search_page_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_users_can_find_appointment_using_the_right_nid(): void
    {
        // $user = User::factory()->create();

        // $response = $this->post('/login', [
        //     'email' => $user->email,
        //     'password' => 'password',
        // ]);

        // $this->assertAuthenticated();
        // $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_find_appointment_using_the_wrong_nid(): void
    {
        // $user = User::factory()->create();

        // $this->post('/login', [
        //     'email' => $user->email,
        //     'password' => 'wrong-password',
        // ]);

        // $this->assertGuest();
    }
}
