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
        $users = User::with('company')->where('id', 198)->get();

        $subject = "Nuestra App ahora es GRATIS";

        try {
            Emails::sendEmailMassive($users, $subject, $type);
        } catch (\Throwable $th) {
            info($th);
        }
    }
}
