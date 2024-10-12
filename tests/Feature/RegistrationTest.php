<?php

namespace Tests\Feature;

use App\Models\VaccineCenter;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    public function test_new_users_can_register(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $vaccineCenter = VaccineCenter::factory()->create();

        $response = $this->followingRedirects()
            ->post('/register', [
                'name' => 'Test User',
                'nid' => '1234567890123',
                'email' => 'test@gmail.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'vaccine_center_id' => $vaccineCenter->id,
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
            ])->assertOk()
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component('Welcome')
            );
    }

    public function test_new_users_can_not_register_with_invalid_nid(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $vaccineCenter = VaccineCenter::factory()->create();

        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'nid' => 'invalid-nid',
            'password' => 'password',
            'password_confirmation' => 'password',
            'vaccine_center_id' => $vaccineCenter->id,
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ])->assertSessionHasErrors('nid');
    }

    public function test_new_users_can_not_rester_with_existing_nid()
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $vaccineCenter = VaccineCenter::factory()->create();
        $user = UserFactory::new()->create([
            'vaccination_center_id' => $vaccineCenter->id,
        ]);

        $this->post('/register', [
            'name' => 'Test User',
            'email' => fake()->unique()->safeEmail(),
            'nid' => $user->nid,
            'password' => 'password',
            'password_confirmation' => 'password',
            'vaccine_center_id' => $vaccineCenter->id,
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ])->assertSessionHasErrors('nid');
    }
}
