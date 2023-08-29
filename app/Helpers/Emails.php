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

                dispatch(new SendEmailJob($parametros));
            }
        }
    }

    static function sendEmailMassive($users, $subject, $type)
    {
        if (@count($users) > 0) {

            foreach ($users as $user) {
                info($user->email);
                $parametros['name'] = $user->company->name;
                $parametros['company'] = $user->company;
                $parametros['destinatario'] = $user->email;
                $parametros['type'] = $type;
                $parametros['subject'] = $subject;
                try {
                    dispatch(new SendEmailJob($parametros));
                    info("Enviado");
                } catch (\Throwable $th) {
                    info($th);
                    //throw $th;
                }
            }
        }
    }
}
