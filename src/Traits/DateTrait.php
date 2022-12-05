<?php

namespace Samsin33\Foundation\Traits;

use DateTime;
use DateTimeZone;

trait DateTrait
{
    /**
     * @param string $datetime
     * @param string $zone_to
     * @param string $format
     * @param string $zone_from
     * @return string
     * @throws \Exception
     */
    public static function convertTimeZone(string $datetime, string $zone_to = 'UTC', string $format = 'Y-m-d H:i:s', string $zone_from = 'UTC'): string
    {
        $date = new DateTime($datetime, new DateTimeZone($zone_from));
        $date->setTimezone(new DateTimeZone($zone_to));
        return $date->format($format);
    }
}
