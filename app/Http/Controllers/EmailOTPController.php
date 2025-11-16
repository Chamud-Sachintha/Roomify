<?php

namespace App\Http\Controllers;

use App\Models\EmailOTP;
use App\Models\User;
use Illuminate\Http\Request;

class EmailOTPController extends Controller
{
    private $EmailOTpModel;
    private $UserModel;

    public function __construct()
    {
        $this->EmailOTpModel = new EmailOTP();
        $this->UserModel = new User();
    }

    public function validateOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|string',
        ]);

        $email = $request->input('email');
        $otp = $request->input('otp_code');

        $isValid = $this->EmailOTpModel->validateOTP($email, $otp);

        if ($isValid) {
            $this->UserModel->markEmailAsVerifiedUser($email);
            return view('login');
        } else {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
    }
}
