<?php

namespace App\Console\Commands;

use App\Helpers\CRON;
use Illuminate\Console\Command;

class TwoDaysAfter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twoDays:after';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía aviso de plan vencido hace 2 días';

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
        return CRON::twoDaysAfter();
    }
}
