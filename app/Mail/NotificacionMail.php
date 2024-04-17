<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }
    public function build()
    {
        return $this->subject('Se ha actualizado un comentario.')
            ->view('comentario.emailconfirm');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificacion Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'comentario.emailconfirm',
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
