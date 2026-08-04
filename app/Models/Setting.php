<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /**
     * Get setting value by key with fallback default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            return Cache::remember('setting_' . $key, 3600, function () use ($key, $default) {
                $setting = static::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Set/update setting value by key.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): static
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget('setting_' . $key);

        return $setting;
    }
}
