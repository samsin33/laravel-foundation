<?php

namespace Samsin33\Foundation\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

trait UserSessionTrait
{
    /**
     * @return Authenticatable|null
     */
    public static function currentUser(): Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * @return mixed|null
     */
    public static function currentUserId(): mixed
    {
        if (self::currentUser()) {
            return self::currentUser()->id;
        }
        return null;
    }

    /**
     * @return string
     */
    public static function getDefaultTimeZone(): string
    {
        return config('app.timezone');
    }

    /**
     * @return string|null
     */
    public static function getIp(): ?string
    {
        return request()->ip();
    }

    /**
     * @return string
     */
    public function getUserTimeZone(): string
    {
        return isset(self::currentUser()->timeZone->time_zone_code) && self::currentUser()->timeZone->time_zone_code ? self::currentUser()->timeZone->time_zone_code : self::getDefaultTimeZone();
    }
}
