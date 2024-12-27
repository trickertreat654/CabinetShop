<?php

namespace App\Mail;

use App\Models\CabinetJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CabinetJobCompleted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $cabinetJob;


    /**
     * Create a new message instance.
     */
    public function __construct(CabinetJob $cabinetJob)
    {
        //
        $this->cabinetJob = $cabinetJob;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cabinet Job Completed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.cabinet-job-completed',
            with: [
                'jobTitle' => $this->cabinetJob->title,
                'completedAt' => $this->cabinetJob->updated_at,
                // 'userName' => $this->cabinetJob->user->name,
            ],
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
