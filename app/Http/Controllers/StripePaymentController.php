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
    private $user;

    public function __construct()
    {
        $this->ClientListingModel = new ClientListing();
        $this->user = Auth::user();
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

    public function showPaymentHistoryPage()
    {
        $payments = AppPayments::with('listing.user')
            ->orderByDesc('created_at')
            ->get();

        return view('app.admin.payment-history')->with([
            'breadcrumb' => 'Payment History',
            'user' => $this->user,
            'payments' => $payments,
        ]);
    }

    public function deletePayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|integer',
        ]);

        $payment = AppPayments::find($request->input('payment_id'));

        if (!$payment) {
            return redirect()->back()->withErrors(['error' => 'Payment not found.']);
        }

        try {
            $payment->delete();
            return redirect()->back()->with('success', 'Payment record deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete payment record.']);
        }
    }
}
