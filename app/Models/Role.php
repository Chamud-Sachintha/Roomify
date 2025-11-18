<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';

    protected $fillable = ['name'];

    public function addRole($roleName)
    {
        return self::create(['name' => $roleName]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
