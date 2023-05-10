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

    static function sendEmailMassive($users, $subject)
    {
        if (@count($users) > 0) {
            foreach ($users as $user) {
                info('Se envió email masivo a: id=>' . $user->id . ' email=>' . $user->email);
                $parametros['name'] = $user->name;
                $parametros['company'] = $user->company;
                $parametros['destinatario'] = $user->email;
                $parametros['type'] = 'Masivo';
                $parametros['subject'] = $subject;
                try {
                    dispatch(new SendEmailJob($parametros));
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
    }
}
