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
        return self::with('user')->where('status', 'approved')->get();
    }

    public function getListingByUserId($userId)
    {
        return self::where('client_id', $userId)->first();
    }

    public function getListingById($id)
    {
        return self::where('id', $id)->first();
    }

    public function getApprovedListingById($id)
    {
        return self::with('user')
            ->where('id', $id)
            ->where('status', 'approved')
            ->first();
    }

    public function getApprovedListingsPaginated($perPage = 10)
    {
        return self::with('user')
            ->where('status', 'approved')
            ->paginate($perPage);
    }

    public function filterListings($filters, $perPage = 10)
    {
        $query = self::with('user')
            ->where('status', 'approved');

        if (!empty($filters['display_name'])) {
            $query->where('display_name', 'like', '%' . $filters['display_name'] . '%');
        }

        if (!empty($filters['category_type_id'])) {
            $query->where('category_type_id', $filters['category_type_id']);
        }

        if (!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        if (!empty($filters['price_range'])) {
            [$minPrice, $maxPrice] = explode('-', $filters['price_range']);

            $query->whereNotNull('rent_for_you');

            if ($maxPrice === '999999999') {
                $query->where('rent_for_you', '>=', (float) $minPrice);
            } else {
                $query->whereBetween('rent_for_you', [(float) $minPrice, (float) $maxPrice]);
            }
        }

        return $query->paginate($perPage);
    }
}
