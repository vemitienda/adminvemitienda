<?php

namespace App\Jobs;

use App\User;
use App\Strategies\SendEmail\Masivo;
use App\Strategies\SendEmail\RecordarPago;
use App\Strategies\SendEmail\CampaniaGratis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ramsey\Uuid\Uuid;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const STRATEGY = [
        'RecordarPago'   => RecordarPago::class,
        'Masivo'   => Masivo::class,
        'CampaniaGratis'   => CampaniaGratis::class,
    ];

    public $parametros;
    public $timeout = 70;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($parametros)
    {
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
        try {
            $estrategyClass = $this::STRATEGY[$this->parametros['type']];
            $estrategy = new $estrategyClass();
            $estrategy->sendEmail($this->parametros);
        } catch (\Throwable $th) {
            //throw $th;
        }
        $user = User::where('email', $this->parametros['destinatario'])->first();
        $user->marketing = 1;
        $user->save();
    }
}
