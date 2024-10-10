<?php

namespace App\Console\Commands;

use App\Mail\VaccineScheduleNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

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
        $schedules = Schedule::whereDate('scheduled_date', $tomorrow)->with('user', 'vaccineCenter')->get();

        foreach ($schedules as $schedule) {
            $user = $schedule->user;
            $vaccineCenter = $schedule->vaccineCenter;
            $scheduledDate = $schedule->scheduled_date;

            // Send email notification
            Mail::to($user->email)->send(new VaccineScheduleNotification($user, $vaccineCenter, $scheduledDate));
        }

        $this->info('Reminder emails sent for users scheduled on ' . $tomorrow->toFormattedDateString());
    }
}
