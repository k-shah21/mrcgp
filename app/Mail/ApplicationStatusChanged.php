<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusChanged extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Application $application
    ) {}

    public function envelope(): Envelope
    {
        $status = ucfirst($this->application->status);

        return new Envelope(
            subject: "Application {$status} – MRCGP [INT] South Asia",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-status-changed',
        );
    }
}
