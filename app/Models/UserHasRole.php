<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasRole extends Model
{
    protected $fillable = ['user_id', 'role_id'];

    public function assignRole($userId, $roleId)
    {
        return self::create(['user_id' => $userId, 'role_id' => $roleId]);
    }
}
