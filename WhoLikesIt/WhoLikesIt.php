<?php

namespace Merexo;

class WhoLikesIt
{
    public static function generate(array $names): string
    {
        switch ($count = count($names)) {
            case 0:
                $str = "no one likes";
                break;
            case 1:
                $str = "{$names[0]} likes";
                break;
            case 2:
                $str = "{$names[0]} and {$names[1]} like";
                break;
            case 3:
                $str = "{$names[0]}, {$names[1]} and {$names[2]} like";
                break;
            default:
                $str = "{$names[0]}, {$names[1]} and " . ($count - 2) . " others like";
                break;
        }

        return "$str this";
    }
}