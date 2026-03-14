<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    public function listings()
    {
        return $this->hasMany(ClientListing::class, 'category_id');
    }

    public function createCategory($data)
    {
        return self::create($data);
    }
}
