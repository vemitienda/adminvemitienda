<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PaymentDetails extends Model
{
    use HasFactory;

    protected $table = 'payment_details';
    protected $fillable = ['payment_id', 'payment_method_id', 'reference_number', 'verified', 'price'];

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }
}
