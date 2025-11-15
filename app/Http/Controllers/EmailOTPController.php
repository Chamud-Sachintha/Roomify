<?php

namespace App\Http\Controllers;

use App\Models\EmailOTP;
use Illuminate\Http\Request;

class EmailOTPController extends Controller
{
    private $EmailOTpModel;

    public function __construct()
    {
        $this->EmailOTpModel = new EmailOTP();
    }

    public function validateOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        $email = $request->input('email');
        $otp = $request->input('otp');

        $isValid = $this->EmailOTpModel->validateOTP($email, $otp);

        if ($isValid) {
            return view('login');
        } else {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
    }
}
