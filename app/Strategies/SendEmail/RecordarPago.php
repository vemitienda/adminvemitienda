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
            Mail::to($data['destinatario'])->send(new RecordatorioPago($data));
        } catch (Exception $th) {
            return null;
        }
    }
}
