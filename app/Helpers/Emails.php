<?php

namespace App\Helpers;

use App\Jobs\SendEmailJob;
use App\User;

class Emails
{
    static function sendEmailsUsers($userPaymentsArray, $message, $subject)
    {
        if (@count($userPaymentsArray) > 0) {

            $users = User::query()
                ->whereIn('id', $userPaymentsArray)
                ->get();

            foreach ($users as $user) {
                //Envío el correo recordatorio a los que tengan pagos pendientes y no tengan pagos adelantados
                $parametros['name'] = $user->name;
                $parametros['destinatario'] = $user->email;
                $parametros['type'] = 'RecordarPago';
                $parametros['subject'] = $subject;
                $parametros['mensaje'] = $message;

                dispatch(new SendEmailJob($parametros));
            }
        }
    }
}
