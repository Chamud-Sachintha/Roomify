<?php

namespace App\Http\Controllers;

use App\Models\AppPayments;
use App\Models\ClientListing;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{

    private $ClientListingModel;

    public function __construct()
    {
        $this->ClientListingModel = new ClientListing();
    }

    public function success(Request $request, PaymentService $stripe)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('dashboard')->with('error', 'Invalid session.');
        }

        // Get the Checkout Session from Stripe
        $session = $stripe->verifySession($sessionId);

        $paymentId = $session->metadata->payment_id;

        $payment = AppPayments::find($paymentId);

        if (!$payment) {
            return redirect()->route('dashboard')->with('error', 'Payment not found.');
        }

        // Check if paid
        if ($session->payment_status === 'paid') {

            $payment->update([
                'status' => 'succeeded',
                'stripe_payment_id' => $session->payment_intent,
            ]);

            $post = $this->ClientListingModel->getListingByUserId(Auth::id());

            return redirect()->route('client_my_listings')->with(['success', 'Listing created successfully.', 'post' => $post]);
        }

        return redirect()->route('dashboard')->with('error', 'Payment not completed.');
    }

    public function cancel()
    {
        // return view('stripe.cancel');
    }
}
