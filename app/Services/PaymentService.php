<?php

namespace App\Services;

use App\Models\AppPayments;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentService{
    
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createCheckout($payment)
{
    $session = StripeSession::create([
        'mode' => 'payment',
        'payment_method_types' => ['card'],

        'line_items' => [[
            'price_data' => [
                'product_data' => ['name' => "Listing Payment #{$payment->listing_id}"],
                'currency' => 'lkr',
                'unit_amount' => $payment->amount * 100,
            ],
            'quantity' => 1,
        ]],

        'success_url' => route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url'  => route('stripe.cancel'),

        'metadata' => [
            'payment_id' => $payment->id,
        ],
    ]);

    return $session->url; // IMPORTANT!
}

    public function verifySession($sessionId)
    {
        return StripeSession::retrieve($sessionId);
    }
}
