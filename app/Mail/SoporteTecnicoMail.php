<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SoporteTecnicoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $email;
    public $asunto;
    public $descripcion;
    
    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $email, $asunto, $descripcion)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->asunto = $asunto;
        $this->descripcion = $descripcion;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: $this->email,
            replyTo: $this->email,
            subject: $this->asunto,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.correoSoporteTecnico',
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