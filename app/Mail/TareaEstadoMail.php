<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TareaEstadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tarea;
    public $tecnico;
    public $encargado;
    public $estado; // nuevo: estado de la tarea

    public function __construct($tarea, $tecnico, $encargado, $estado)
    {
        $this->tarea = $tarea;
        $this->tecnico = $tecnico;
        $this->encargado = $encargado;
        $this->estado = $estado;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Tarea {$this->estado}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.correoEstadoTarea', // podés usar una sola vista con condicionales
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
