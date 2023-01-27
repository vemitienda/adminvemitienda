<?php

namespace App\Console\Commands;

use App\Helpers\CRON;
use Illuminate\Console\Command;

class ThreeDaysBefore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'threeDays:before';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía aviso de vencimiento dentro de 3 días';

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
        return CRON::threeDaysBefore();
    }
}
