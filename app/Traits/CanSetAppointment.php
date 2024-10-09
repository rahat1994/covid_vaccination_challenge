<?php

namespace App\Traits;

use App\Models\Appointment;
use App\Models\VaccineCenter;
use Carbon\Carbon;

trait CanSetAppointment
{
    public function setAppointment(): void
    {
        Appointment::create([
            'user_id' => $this->user->id,
            'vaccination_center_id' => $this->user->vaccination_center_id,
            'appointment_at' => static::getNextAvailableDate($this->user->vaccination_center_id),
        ]);
    }

    public static function getNextAvailableDate(string $vaccineCenter): string
    {
        $vaccineCenter = VaccineCenter::find($vaccineCenter);
        $currentDate = Carbon::now();

        // Start from the next weekday (excluding Friday and Saturday)
        while (true) {
            if (in_array($currentDate->dayOfWeek, [Carbon::FRIDAY, Carbon::SATURDAY])) {
                $currentDate->addDay();
                continue;
            }

            // Count how many appointments are scheduled for this center on the current date
            $scheduledCount = Appointment::where('vaccination_center_id', $vaccineCenter->id)
                ->whereDate('appointment_at', $currentDate->toDateString())
                ->count();

            // Check if there's room for more appointments based on the daily limit
            if ($scheduledCount < $vaccineCenter->daily_limit) {
                return $currentDate;
            }

            // If the daily limit is reached, move to the next weekday
            $currentDate->addDay();
        }
    }
}
