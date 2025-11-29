<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientListing extends Model
{
    protected $fillable = [
        'client_id',
        'location', // urban, suburban, rural
        'number_of_persons',
        'images', // comma separated values of image paths max 5
        'total_rent',
        'rent_for_you',
        'facilities', //comma separated values
        'floor', // ground, first, second, etc.
        'has_elevator', // boolean
        'has_parking', // boolean
        'ocupation', // employed, student, unemployed, retired
        'personal_habbits', // comma separated values
        'gender',
        'notes',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function createNewListing(array $data) {
        return self::create($data);
    }
}
