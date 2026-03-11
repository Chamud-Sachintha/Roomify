<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileSettings extends Model
{
    protected $fillable = [
        'user_id',
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

    public function createProfileSettings($data)
    {
        return self::create([
            'user_id' => $data['id'],
            'display_name' => $data['display_name'] ?? null,
            'email' => $data['email'] ?? null,
        ]);
    }
}
