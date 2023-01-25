<?php

namespace App\Http\Controllers;

use App\Helpers\Fechas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PruebasController extends Controller
{
    //Parar probar que se suman bien los meses en el helper
    public function sumarMeses($quantiy)
    {
        $data['fechaActual'] = Carbon::parse(now())->format('d-m-Y');
        $data['fechaFutura'] = Fechas::addMonths($data['fechaActual'], $quantiy)->format('d-m-Y');
        return response()->json($data);
    }

    // Para probar que los días se restan bien
    public function restarDias($quantity)
    {
        $data['date'] = now();
        $data['endDate'] = '2023-01-29';
        $data['quantiy'] = $quantity;
        $data['result'] = Fechas::daysBefore($data['date'], $data['endDate'], $data['quantiy']);
        return response()->json($data);
    }

    // Para probar que los días se suman bien
    public function sumarDias($quantity)
    {
        $data['date'] = now();
        $data['endDate'] = '2023-01-30';
        $data['quantiy'] = $quantity;
        $data['result'] = Fechas::daysBefore($data['date'], $data['endDate'], $data['quantiy']);
        return response()->json($data);
    }
}
