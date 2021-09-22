<?php

namespace Merexo;

class CaesarCipher
{
    const ASCII_SKIP = 96; // class now works only with latin
    const ALLOWED_RANGE = [
        'min' => 1,
        'max' => 26
    ];

    private $shift = 0;

    public function __construct(int $shift)
    {
        $this->shift = $shift;
    }

    public function encode(string $str)
    {
        return $this->execute($str);
    }

    public function decode(string $str)
    {
        return $this->execute($str, true);
    }

    private function execute(string $str, bool $reverse = false)
    {
        $str = Word::normalizeTextToLowerCase($str);
        $arr = str_split($str);
        array_walk($arr, function (&$value) use ($reverse) {
            $value = $this->shiftChar($value, $reverse);
        });

        return strtoupper(implode('', $arr));
    }

    private function shiftChar(string $char, bool $reverse = false)
    {
        $char_ascii = ord($char);

        if (!$this->isAllowedRange($char_ascii)) return $char;

        $shift = $reverse ? -$this->shift : $this->shift;

        $new_code = ord($char) - self::ASCII_SKIP + $shift;
        $shifted_ascii = $this->transformToAllowedRange($new_code) + self::ASCII_SKIP;

        return chr($shifted_ascii);
    }

    private function isAllowedRange(int $ascii_code)
    {
        $ascii_code -= self::ASCII_SKIP;

        return NumberHelper::inRange(
            $ascii_code,
            self::ALLOWED_RANGE['min'],
            self::ALLOWED_RANGE['max'],
            false
        );
    }

    private function transformToAllowedRange(int $ascii_code)
    {
        if ($ascii_code > self::ALLOWED_RANGE['max']) {
            return $ascii_code - self::ALLOWED_RANGE['max'];
        }

        if ($ascii_code < self::ALLOWED_RANGE['min']) {
            return $ascii_code + self::ALLOWED_RANGE['max'];
        }

        return $ascii_code;
    }
}