<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    public static function setValue(string $key, $value): self
    {
        $setting = static::firstOrNew(['key' => $key]);
        $setting->value = (string) $value;
        $setting->save();

        return $setting;
    }
}
