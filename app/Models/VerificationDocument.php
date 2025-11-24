<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationDocument extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function create_document($data)
    {
        return self::create([
            'name' => $data['name'],
            'status' => $data['status'],
        ]);
    }

    public function get_all_documents()
    {
        return self::all();
    }
}
