<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientListing extends Model
{
    protected $fillable = [
        'client_id',
        'display_name',
        'category_type_id',
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
        'contact_number',
        'contact_email',
        'gender',
        'notes',
        'status',
        'remark'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function categoryType() {
        return $this->belongsTo(Category::class, 'category_type_id');
    }

    public static function createListing($userId,array $validated, array $imagePaths)
    {
        return self::create([
            'client_id'         => $userId,
            'display_name'      => $validated['display_name'] ?? null,
            'category_type_id'  => $validated['category_type_id'] ?? null,
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
            'contact_number'    => $validated['contact_number'] ?? null,
            'contact_email'     => $validated['contact_email'] ?? null,
            'notes'             => $validated['notes'] ?? null,
            'status'            => $validated['status'] ?? 'pending',
            'remark'            => $validated['remark'] ?? null,
            'images'            => implode(',', $imagePaths),
        ]);
    }

    public function getAllListings()
    {
        return self::with('user')->get();
    }

    public function getListingByUserId($userId)
    {
        return self::where('client_id', $userId)->first();
    }

    public function getListingById($id) {
        return self::where('id', $id)->first();
    }

    public function getAllListingsPaginated($perPage = 10)
    {
        return $this->paginate($perPage);
    }
}
