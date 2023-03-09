<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecordatorioPago extends Mailable
{
    use Queueable, SerializesModels;

    protected $datos;
    public $vista;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        $this->datos = $datos;
        $this->subject = $datos['subject'];
        $this->vista = 'Mails.RecordatorioPago';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        info('Entro donde se llama la vista');
        return $this->view($this->vista)->with($this->datos);
    }
}
