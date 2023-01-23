<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $table    = 'services';
    protected $fillable = ['name', 'quantity'];

    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan');
    }

    public function planservices()
    {
        return $this->hasMany('App\Models\PlanService', 'service_id');
    }
}
