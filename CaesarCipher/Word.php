<?php

namespace Merexo;

class Word
{
    public static function normalizeTextToLowerCase(string $str)
    {
        return strtolower(trim($str));
    }
}