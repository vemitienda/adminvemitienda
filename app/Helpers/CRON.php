<?php

namespace App\Helpers;

use App\Jobs\SendEmailJob;
use App\Models\Payment;
use App\Models\PlanUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CRON
{
    static function threeDaysBefore()
    {
        $threDaysAfter = Carbon::parse(now())->addDays(3)->format('Y-m-d');
        /* Selecciono los PlanUser cuya end_date es igual a threDaysAfter */

        $userPaymentsArray = PlanUser::query()
            ->where('end_date', $threDaysAfter)
            ->pluck('user_id');

        $message = "Recordatorio de vencimiento próximo";
        $subject = "Le hacemos un recordatorio amistoso, de que su plan vencerá dentro de 3 días. Puede seguir probando la aplicación sin problemas";

        $this->sendEmailsUsers($userPaymentsArray, $message, $subject);
    }

    static function twoDaysAfter()
    {
        $twoDaysAfter = Carbon::parse(now())->subDays(2)->format('Y-m-d');
        /* Selecciono los planes cuya end_date es igual a twoDaysAfter */
        $userPaymentsArray = PlanUser::query()
            ->where('end_date', $twoDaysAfter)
            ->pluck('user_id');

        $message = "Recordatorio de pago vencido";
        $subject = "Le hacemos un recordatorio amistoso, de que su plan venció hace 2 días. Puede seguir probando la aplicación por 2 días más";

        $this->sendEmailsUsers($userPaymentsArray, $message, $subject);
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

    public function sendEmailsUsers($userPaymentsArray, $message, $subject)
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
