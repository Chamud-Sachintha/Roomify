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
        'occupation', // employed, student, unemployed, retired
        'personal_habbits', // comma separated values
        'gender',
        'notes',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public static function createListing($userId,array $validated, array $imagePaths)
    {
        return self::create([
            'client_id'         => $userId,
            'location'          => $validated['location'],
            'number_of_persons' => $validated['number_of_persons'] ?? null,
            'total_rent'        => $validated['total_rent'] ?? null,
            'rent_for_you'      => $validated['rent_for_you'] ?? null,
            'floor'             => $validated['floor'] ?? null,
            'has_elevator'      => $validated['has_elevator'],
            'has_parking'       => $validated['has_parking'],
            'occupation'         => $validated['ocupation'] ?? null,
            'gender'            => $validated['gender'] ?? null,
            'facilities'        => $validated['facilities'] ?? '',
            'personal_habbits'  => $validated['personal_habbits'] ?? '',
            'notes'             => $validated['notes'] ?? null,
            'images'            => implode(',', $imagePaths),
        ]);
    }
}
