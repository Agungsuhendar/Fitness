<?php

use App\Models\Setting;

if (!function_exists('site_setting')) {
    /**
     * Get site setting value by key with optional default fallback.
     */
    function site_setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}
