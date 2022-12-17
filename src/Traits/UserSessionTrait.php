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
}
