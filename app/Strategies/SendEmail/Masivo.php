<?php

namespace App\Strategies\SendEmail;

use App\Mail\Masivo as EmailMasivo;
use App\Strategies\SendEmailInterface;
use Exception;
use Illuminate\Support\Facades\Mail;

class Masivo implements SendEmailInterface
{
    public function sendEmail($data)
    {
        try {
            Mail::to($data['destinatario'])->send(new EmailMasivo($data));
        } catch (Exception $th) {
            return null;
        }
    }
}
