<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailOTP extends Model
{
    protected $fillable = [
        'email',
        'otp_code',
        'expires_at',
    ];

    public function createOTPForMail(array $data)
    {
        return self::create([
            'email' => $data['email'],
            'otp_code' => $data['otp_code'],
            'expires_at' => $data['expires_at'],
        ]);
    }

    public function validateOTP($email, $otp)
    {
        $record = self::where('email', $email)
            ->where('otp_code', $otp)
            ->where('expires_at', '>', now())
            ->first();

        return $record !== null;
    }
}
