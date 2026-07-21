<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Mail\AccountVerificationMail;
use App\Mail\PasswordResetMail;
use App\Models\EmailOTP;
use App\Models\ProfileSettings;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    private $UserModel;
    private $EmailOTPModel;
    private $profileSettingsModel;
    private $AppHelper;

    public function __construct()
    {
        $this->UserModel = new User();
        $this->EmailOTPModel = new EmailOTP();
        $this->profileSettingsModel = new ProfileSettings();
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
            $user = $this->UserModel->createNewUser($validatedData);
            $this->profileSettingsModel->createProfileSettings([
                'id' => $user->id,
                'display_name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);

            $defaultRoleId = Role::where('name', Role::ROLE_USER)->first()->id;
            $user->roles()->attach($defaultRoleId);

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

    public function authenticateUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = $this->UserModel->userFindByEmail($credentials['email']);

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if (!$user->is_verified) {
                return back()->withErrors(['error' => 'Please verify your email before logging in.']);
            }

            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['error' => 'Invalid email or password.']);
        }
    }

    public function showForgotPasswordPage()
    {
        return view('forgot_password');
    }

    public function requestPasswordReset(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        $user = $this->UserModel->userFindByEmail($validatedData['email']);
        $otp = $this->AppHelper->generateUniqueOtp();

        $this->EmailOTPModel->createOTPForMail([
            'email' => $user->email,
            'otp_code' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new PasswordResetMail($user, $otp));

        return view('reset_password', compact('user'));
    }

    public function resetUserPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'otp_code' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $isValidOtp = $this->EmailOTPModel->validateOTP($validatedData['email'], $validatedData['otp_code']);

        if (!$isValidOtp) {
            return back()->withErrors(['otp_code' => 'Invalid or expired OTP.']);
        }

        $user = $this->UserModel->userFindByEmail($validatedData['email']);
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        $this->EmailOTPModel->where('email', $validatedData['email'])->delete();

        return redirect()->route('login_page')->with('success', 'Password reset successfully. Please sign in with your new password.');
    }

}
