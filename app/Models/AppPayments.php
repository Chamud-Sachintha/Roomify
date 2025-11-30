<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppPayments extends Model
{
    protected $fillable = [
        'listing_id',
        'order_id',
        'status',
        'amount'
    ];

    public function createPaymentDetails($details) {
        return self::create($details);
    }
}
