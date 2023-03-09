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
        info('ejecutó threeDaysBefore');
        $threDaysAfter = Carbon::parse(now())->addDays(3)->format('Y-m-d');
        /* Selecciono los planes cuya end_date es igual a threDaysAfter */
        $userPaymentsArray = Payment::query()
            ->where('end_date', $threDaysAfter)
            ->where('paid_out', 0)
            ->pluck('email', 'name');


        $userPagosAdelantadosArray = Payment::query()
            ->where('start_date', '>', Carbon::parse(now())->format('Y-m-d H:i:s'))
            ->where('paid_out', 1)
            ->pluck('email', 'name');

        if (@count($userPaymentsArray) > 0) {

            $users = User::query()
                ->whereIn('id', $userPaymentsArray)
                ->get();

            foreach ($users as $user) {
                if (!in_array($user->id, count($userPagosAdelantadosArray) > 0 ? $userPagosAdelantadosArray : [])) {
                    //Envío el correo recordatorio a los que tengan pagos pendientes y no tengan pagos adelantados
                    $parametros['name'] = $user->name;
                    $parametros['destinatario'] = $user->email;
                    $parametros['type'] = 'RecordarPago';
                    $parametros['subject'] = 'Recordatorio de vencimiento próximo';
                    $parametros['mensaje'] = 'Le hacemos un recordatorio amistoso, de que su plan vencerá dentro de 3 días.';

                    dispatch(new SendEmailJob($parametros));
                }
            }
        }
    }

    static function twoDaysAfter()
    {
        info('ejecutó twoDaysAfter');
        $threDaysAfter = Carbon::parse(now())->subDays(2)->format('Y-m-d');
        /* Selecciono los planes cuya end_date es igual a threDaysAfter */
        $userPaymentsArray = Payment::query()
            ->where('end_date', $threDaysAfter)
            ->where('paid_out', 0)
            ->pluck('user_id');

        if (@count($userPaymentsArray) > 0) {
            $emails = User::whereIn('id', $userPaymentsArray)->pluck('email', 'name');
            foreach ($emails as $name => $email) {
                //Envío el correo recordatorio a cada email
                $parametros['name'] = $name;
                $parametros['destinatario'] = $email;
                $parametros['type'] = 'RecordarPago';
                $parametros['subject'] = 'Recordatorio de pago vencido';
                $parametros['mensaje'] = 'Le hacemos un recordatorio amistoso, de que su plan venció hace 2 días.';

                dispatch(new SendEmailJob($parametros));
            }
        }
    }

    static function fiveDaysAfter()
    {
        info('ejecutó fiveDaysAfter');
        $threDaysAfter = Carbon::parse(now())->subDays(5)->format('Y-m-d');
        /* Selecciono los planes cuya end_date es igual a threDaysAfter */
        $userPaymentsArray = Payment::query()
            ->where('end_date', $threDaysAfter)
            ->where('paid_out', 0)
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
