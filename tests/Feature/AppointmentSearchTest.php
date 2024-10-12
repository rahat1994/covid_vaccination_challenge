<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\VaccineCenter;
use Database\Factories\VaccineCenterFactory;
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
        $vaccineCenter = VaccineCenter::factory()->create();
        $user = User::factory()->create(
            [
                'nid' => '1234567890123',
                'vaccination_center_id' => $vaccineCenter->id,
            ]
        );

        $response = $this->post('/get-status', [
            'value' => $user->nid,
        ]);

        $response->assertOk();
    }

    public function test_users_can_not_find_appointment_using_the_wrong_nid(): void
    {
        $vaccineCenter = VaccineCenter::factory()->create();
        $user = User::factory()->create(
            [
                'nid' => '1234567890123',
                'vaccination_center_id' => $vaccineCenter->id,
            ]
        );

        $response = $this->post('/get-status', [
            'value' => 'sfasdg',
        ]);

        $response->assertStatus(302);
    }
}
