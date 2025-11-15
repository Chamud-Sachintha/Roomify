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
}
