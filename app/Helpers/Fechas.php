<?php

namespace App\Helpers;

use Carbon\Carbon;

class Fechas
{
    static function addMonths($date, $quantity)
    {
        return Carbon::parse($date)->addMonths($quantity);
    }

    static function daysBefore($date, $endDate, $quantiy)
    {
        $sub = Carbon::parse($endDate)->subDays($quantiy)->format('Y-m-d');
        $now = Carbon::parse($date)->format('Y-m-d');
        if ($sub == $now) {
            return true;
        } else {
            return false;
        }
    }

    static function daysAfter($date, $endDate, $quantiy)
    {
        $before = Carbon::parse($date)->addDays($quantiy)->format('Y-m-d');
        $end = Carbon::parse($endDate)->format('Y-m-d');
        if ($before == $end) {
            return true;
        } else {
            return false;
        }
    }
}
