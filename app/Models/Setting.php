<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /**
     * Ensure table and columns exist safely for production without CLI migrations.
     */
    public static function ensureTable()
    {
        try {
            if (!Schema::hasTable('settings')) {
                Schema::create('settings', function (Blueprint $table) {
                    $table->id();
                    $table->string('key')->unique();
                    $table->text('value')->nullable();
                    $table->string('group')->default('general');
                    $table->timestamps();
                });
            } else if (!Schema::hasColumn('settings', 'group')) {
                Schema::table('settings', function (Blueprint $table) {
                    $table->string('group')->default('general')->after('value');
                });
            }
        } catch (\Throwable $e) {
            // Log or ignore schema check error
        }
    }

    /**
     * Get setting value by key with fallback default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            static::ensureTable();
            return Cache::remember('setting_' . $key, 3600, function () use ($key, $default) {
                $setting = static::where('key', $key)->first();
                return $setting && $setting->value !== null ? $setting->value : $default;
            });
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Set/update setting value by key.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): static
    {
        static::ensureTable();

        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        try {
            Cache::forget('setting_' . $key);
        } catch (\Throwable $e) {}

        return $setting;
    }
}
