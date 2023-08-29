<?php

namespace App\Http\Controllers;

use App\Helpers\Emails;
use App\User;
use Illuminate\Http\Request;

class SendEmailsController extends Controller
{
    public function masivo()
    {
        $type = request()->type;
        $users = User::with('company')->where('invalid', 0)->where('marketing', 0)->limit(10)->get();

        $subject = "Nuestra App ahora es GRATIS";

        try {
            Emails::sendEmailMassive($users, $subject, $type);
        } catch (\Throwable $th) {
            info($th);
        }
    }
}
