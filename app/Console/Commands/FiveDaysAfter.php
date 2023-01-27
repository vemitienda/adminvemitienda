<?php

namespace App\Console\Commands;

use App\Helpers\CRON;
use Illuminate\Console\Command;

class FiveDaysAfter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fiveDaysAfter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando que quita los planes vencidos al día de hoy';

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
        return CRON::fiveDaysAfter();
    }
}
