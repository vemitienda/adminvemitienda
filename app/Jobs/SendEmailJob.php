<?php

namespace App\Jobs;

use App\Strategies\SendEmail\RecordarPago;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const STRATEGY = [
        'RecordarPago'   => RecordarPago::class,
    ];

    public $parametros;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($parametros)
    {
        info($parametros);
        $this->parametros = $parametros;
        $this->queue      = 'emails';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $estrategyClass = $this::STRATEGY[$this->parametros['type']];
        $estrategy = new $estrategyClass();
        $estrategy->sendEmail($this->parametros);
    }
}
