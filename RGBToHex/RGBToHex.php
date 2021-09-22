<?php

namespace Merexo;

class RGBToHex
{
    function convert($r, $g, $b)
    {
        return sprintf("%02X%02X%02X", self::checkValue($r), self::checkValue($g), self::checkValue($b));
    }

    private static function checkValue($value)
    {
        return $value > 255 ? 255 : ($value < 0 ? 0 : $value);
    }
}