<?php

namespace App\Helpers;

use App\Models\PlanUser;
use Carbon\Carbon;


class CRON
{
    static function threeDaysBefore()
    {
        $threDaysAfter = Carbon::parse(now())->addDays(3)->format('Y-m-d');
        /* Selecciono los PlanUser cuya end_date es igual a threDaysAfter */

        $userPaymentsArray = PlanUser::query()
            ->where('end_date', $threDaysAfter)
            ->pluck('user_id');

        $subject = "Recordatorio de vencimiento próximo";
        $message = "Le hacemos un recordatorio amistoso, de que su plan vencerá dentro de 3 días. Puede seguir probando la aplicación sin problemas";

        try {
            Emails::sendEmailsUsers($userPaymentsArray, $message, $subject);
        } catch (\Throwable $th) {
            info("Error enviando correo");
            info($th);
        }
    }

    static function twoDaysAfter()
    {
        $twoDaysAfter = Carbon::parse(now())->subDays(2)->format('Y-m-d');
        /* Selecciono los planes cuya end_date es igual a twoDaysAfter */
        $userPaymentsArray = PlanUser::query()
            ->where('end_date', $twoDaysAfter)
            ->pluck('user_id');

        $subject = "Recordatorio de pago vencido";
        $message = "Le hacemos un recordatorio amistoso, de que su plan venció hace 2 días. Puede seguir probando la aplicación por 2 días más";

        try {
            Emails::sendEmailsUsers($userPaymentsArray, $message, $subject);
        } catch (\Throwable $th) {
            info("Error enviando correo");
            info($th);
        }
    }

    static function fiveDaysAfter()
    {
        $fiveDaysAfter = Carbon::parse(now())->subDays(5)->format('Y-m-d');
        /* Selecciono los planes cuya end_date es igual a fiveDaysAfter */
        $userPaymentsArray = PlanUser::query()
            ->where('end_date', $fiveDaysAfter)
            ->pluck('user_id');

        if (@count($userPaymentsArray) > 0) {
            foreach ($userPaymentsArray as $user_id) {
                // A éstos usuarios se les quita el plan
                $planUser = PlanUser::where('user_id', $user_id)->first();
                $planUser->plan_id = 1;
                $planUser->activo = 1;
                $planUser->save();
            }
        }
    }
}
