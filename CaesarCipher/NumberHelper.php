<?php

namespace Merexo;

class NumberHelper
{
    public static function inRange($num, $min, $max, $strict = true)
    {
        if ($strict) {
            return $num > $min && $num < $max;
        } else {
            return $num >= $min && $num <= $max;
        }
    }
}