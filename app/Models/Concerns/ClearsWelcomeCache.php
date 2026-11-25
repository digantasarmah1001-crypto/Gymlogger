<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Cache;

trait ClearsWelcomeCache
{
    protected static function bootClearsWelcomeCache(): void
    {
        static::saved(fn () => Cache::forget('welcome'));
        static::deleted(fn () => Cache::forget('welcome'));
    }
}
