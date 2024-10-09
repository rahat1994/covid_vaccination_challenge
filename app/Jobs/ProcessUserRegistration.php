<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessUserRegistration implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Appointment::create([
            'user_id' => $this->user->id,
            'vaccination_center_id' => $this->user->vaccination_center_id,
            'appointment_at' => now()->addDays(7),
        ]);
        // Send a welcome email to the user
        // Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
    }
}
