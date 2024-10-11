<?php

namespace App\Console\Commands;

use App\Mail\VaccineScheduleNotification;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendVaccineReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send vaccine reminder emails to users scheduled for the next day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow();

        // Find all schedules for tomorrow
        $schedules = Appointment::whereDate('appointment_at', $tomorrow)->with('user', 'vaccinationCenter')->get();
        try {
            foreach ($schedules as $schedule) {
                $user = $schedule->user;
                $vaccineCenter = $schedule->vaccinationCenter;
                $scheduledDate = $schedule->appointment_at;

                // Send email notification
                Mail::to($user->email)->send(new VaccineScheduleNotification($user, $vaccineCenter, $scheduledDate));
            }
        } catch (\Exception $e) {
            $this->error('Failed to send reminder emails. ' . $e->getMessage());
            return;
        }

        $this->info('Reminder emails sent for users scheduled on ' . $tomorrow->toFormattedDateString());
    }
}
