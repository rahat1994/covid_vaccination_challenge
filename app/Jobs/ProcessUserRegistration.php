<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\User;
use App\Traits\CanSetAppointment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessUserRegistration implements ShouldQueue
{
    use Queueable, CanSetAppointment;
    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->setAppointment();
        // Send a welcome email to the user
        // Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
    }
}
