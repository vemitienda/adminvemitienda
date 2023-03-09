<?php

namespace App\Strategies\SendEmail;

use App\Mail\RecordatorioPago;
use App\Strategies\SendEmailInterface;
use Exception;
use Illuminate\Support\Facades\Mail;

class RecordarPago implements SendEmailInterface
{
    public function sendEmail($data)
    {
        try {
            info('Iniciando el envio de email');
            Mail::to($data['destinatario'])->send(new RecordatorioPago($data));
            info('Finalizando el envio de email');
        } catch (Exception $th) {
            return null;
        }
    }
}
