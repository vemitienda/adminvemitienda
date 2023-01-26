<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';
    protected $fillable = ['name', 'quantity'];

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'plan_services');
    }

    public function planservices()
    {
        return $this->hasMany('App\Models\PlanService', 'plan_id');
    }

    public function planuser()
    {
        return $this->hasMany('App\Models\PlanUser', 'plan_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'plan_users');
    }
}
