<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class AppHelper
{
    // Helper functions can be added here in the future 
    function generateUniqueOtp()
    {
        do {
            // Generate 6-digit OTP
            $otp = rand(100000, 999999);

            // Check if exists in DB
            $exists = DB::table('email_o_t_p_s')->where('otp_code', $otp)->exists();

        } while ($exists);

        return $otp;
    }
}

?>