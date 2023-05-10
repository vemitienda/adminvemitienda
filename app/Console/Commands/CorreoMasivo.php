<?php

namespace App\Console\Commands;

use App\Helpers\Emails;
use App\User;
use Illuminate\Console\Command;

class CorreoMasivo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'correoMasivo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Correo masivo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('company')->get();
        $subject = "¿Necesitas ayuda?";

        return Emails::sendEmailMassive($users, $subject);
    }
}
