<?php

namespace App\Services;

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
                    'currency' => 'lkr',
                    'unit_amount' => $payment->amount * 100,
                    'product_data' => [
                        'name' => "Roomify Listing Payment #{$payment->order_id}",
                        'images' => [
                            "https://cdn-icons-png.flaticon.com/512/69/69524.png"
                        ],
                    ],
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('stripe.cancel'),
            'metadata' => [
                'payment_id' => $payment->id,
                'company_name' => 'Roomify'
            ],
        ]);

        return $session->url; // IMPORTANT!
    }

    public function verifySession($sessionId)
    {
        return StripeSession::retrieve($sessionId);
    }
}
