<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['user_id', 'name'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
