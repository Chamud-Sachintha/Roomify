<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileSettings extends Model
{
    protected $fillable = [
        'display_name',
        'profile_picture',
        'first_name',
        'last_name',
        'phone_number',
        'gender',
        'date_of_birth',
        'occupation',
        'email',
        'bio',
    ];
}
