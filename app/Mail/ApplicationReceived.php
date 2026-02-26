<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Application $application)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Received – South Asia MRCGP [INT] Part 1 (AKT) Examination',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-received',
        );
    }

    /**
     * Return empty attachments array — no attachments needed.
     */
    public function attachments(): array
    {
        return [];
    }
}
