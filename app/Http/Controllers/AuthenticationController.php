<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Mail\AccountVerificationMail;
use App\Models\EmailOTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    private $UserModel;
    private $EmailOTPModel;
    private $AppHelper;

    public function __construct()
    {
        $this->UserModel = new User();
        $this->EmailOTPModel = new EmailOTP();
        $this->AppHelper = new AppHelper();
    }

    public function registerNewUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $user = $this->UserModel->create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            $otp = $this->AppHelper->generateUniqueOtp();

            $this->EmailOTPModel->createOTPForMail([
                'email' => $user->email, 
                'otp_code' => $otp,            
                'expires_at' => now()->addMinutes(10),
            ]);

            Mail::to($user->email)->send(new AccountVerificationMail($user, $otp));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return view('verify_otp', compact('user'));
    }

}
