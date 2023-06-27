<?php

namespace App\Mail;

use App\Models\ATC;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ATCSuspensionMail extends Mailable
{
    use Queueable, SerializesModels;

    public ATC $atc;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ATC $atc)
    {
        $this->atc = $atc;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notificación de suspensión',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.ATCSuspension',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
