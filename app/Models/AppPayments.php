<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientListing;

class AppPayments extends Model
{
    protected $fillable = [
        'listing_id',
        'order_id',
        'status',
        'amount',
        'stripe_payment_id'
    ];

    public function listing()
    {
        return $this->belongsTo(ClientListing::class, 'listing_id');
    }

    public function createPaymentDetails($details) {
        return self::create($details);
    }
}
