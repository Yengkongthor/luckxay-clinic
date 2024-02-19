<?php
namespace App\Utils;

use Carbon\Carbon;

class DateTimeUtil
{
    /**
     * Date format
     *
     * @param String $date
     * @param String $format default Y-m-d
     * @return String
     **/
    public static function dateFormat($date, $format = 'Y-m-d')
    {
        return Carbon::parse($date)->format($format);
    }

    /**
     * Time format
     *
     * @param String $time
     * @param String $format default H:i
     * @return String
     **/
    public static function timeFormat($time, $format = 'H:i')
    {
        return Carbon::parse($time)->format($format);
    }
}
