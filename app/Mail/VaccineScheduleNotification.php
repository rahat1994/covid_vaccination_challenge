<?php

namespace App\Mail;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VaccineScheduleNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public User $user,
        public VaccineCenter $vaccineCenter,
        public string $appointmentAt,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vaccine Schedule Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        Log::info('Sending vaccine schedule notification to ' . $this->user->email);
        return new Content(
            view: 'emails.vaccine_schedule_notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
