<?php

namespace Merexo;

class HashtagGenerator
{
    public static function generate($str)
    {
        $str = preg_replace("/\s+/", "", ucwords($str));
        return ($str and strlen($str) < 140) ? "#$str" : false;
    }
}