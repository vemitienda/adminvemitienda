<?php

namespace App\Http\Controllers;

use App\Helpers\Emails;
use App\User;
use Illuminate\Http\Request;

class SendEmailsController extends Controller
{
    public function masivo()
    {
        $users = User::with('company')
            ->get();

        $subject = "¿Necesitas ayuda?";

        try {
            Emails::sendEmailMassive($users, $subject);
        } catch (\Throwable $th) {
            info($th);
        }
    }
}
