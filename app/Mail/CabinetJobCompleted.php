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
    public $customer;
    public $trips;
    public $images;

    /**
     * Create a new message instance.
     */
    public function __construct(CabinetJob $cabinetJob)
    {
        //
        $this->cabinetJob = $cabinetJob;
        $this->customer = $cabinetJob->customer; // Assuming customer exists
        $this->trips = $cabinetJob->trips; // Assuming trips relation is loaded
        $this->images = $cabinetJob->images; // Assuming images relation is loaded
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
                'jobDescription' => $this->cabinetJob->description,
                'customerName' => $this->customer->name,
                'customerEmail' => $this->customer->email,
                'trips' => $this->trips,
                'images' => $this->images,
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
