<?php

namespace Samsin33\Foundation\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

trait CacheTrait
{
    /**
     * @var bool $is_cached
     */
    protected static bool $is_cached = false;

    /**
     * @var array $cache_fields
     */
    protected static array $cache_fields = [];

    /**
     * @var array $cache_conditions
     */
    protected static array $cache_conditions = [];

    /**
     * @param string $key
     * @return string
     */
    public static function getCacheKey(string $key): string
    {
        return strtolower(Str::of(Str::after(get_called_class(), 'App\\'))->replace('\\', '_')->replace('/', '_'))."_$key";
    }

    /**
     * @param string $k
     * @return bool|mixed
     */
    public static function getCache(string $k): mixed
    {
        $key = self::getCacheKey($k);
        if (!Cache::get($key)) {
            $object = get_called_class()::select(get_called_class()::$cache_fields)->where(get_called_class()::$cache_conditions[$k])
                ->get();
            return self::setCache($object, $k);
        }
        return Cache::get($key);
    }

    /**
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public static function setCache(mixed $value, string $key): bool
    {
        if (self::$is_cached) {
            $key = self::getCacheKey($key);
            return Cache::put($key, $value, (60 * 60 * 24));
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function setAllCache(): bool
    {
        if (self::$is_cached) {
            foreach (get_called_class()::$cache_conditions as $key => $cache_condition) {
                $object = get_called_class()::select(get_called_class()::$cache_fields)->where($cache_condition)->get();
                self::setCache($object, $key);
            }
            return true;
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function destroyCache(string $key): bool
    {
        if (self::$is_cached) {
            $key = self::getCacheKey($key);
            Cache::forget($key);
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function destroyAllCache(): bool
    {
        if (self::$is_cached) {
            foreach (array_keys(get_called_class()::$cache_conditions) as $key) {
                self::destroyCache($key);
            }
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function resetAllCache(): bool
    {
        self::destroyAllCache();
        self::setAllCache();
        return true;
    }
}
