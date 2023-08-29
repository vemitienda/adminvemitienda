<?php

namespace App\Strategies\SendEmail;

use App\Mail\CampaniaGratis as EmailCampaniaGratis;
use App\Strategies\SendEmailInterface;
use Exception;
use Illuminate\Support\Facades\Mail;

class CampaniaGratis implements SendEmailInterface
{
    public function sendEmail($data)
    {
        try {
            Mail::to($data['destinatario'])->send(new EmailCampaniaGratis($data));
        } catch (Exception $th) {
            return null;
        }
    }
}
