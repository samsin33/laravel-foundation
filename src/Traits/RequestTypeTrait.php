<?php

namespace Samsin33\Foundation\Traits;

use Illuminate\Support\Str;

trait RequestTypeTrait
{
    public static function isJsonType(): bool
    {
        return request()->wantsJson() || request()->header('Content-Type') == 'application/json';
    }
}
