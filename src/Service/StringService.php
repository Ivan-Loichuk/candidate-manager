<?php


namespace App\Service;


class StringService
{
    /**
     * @param string $str
     * @return string
     */
    public static function uc_first(string $str): string
    {
        if (mb_check_encoding($str, 'UTF-8')) {
            $first = mb_substr(mb_strtoupper($str, 'UTF-8'), 0, 1, 'UTF-8');
            return $first . mb_substr(mb_strtolower($str, 'UTF-8'), 1, mb_strlen($str), 'UTF-8');
        }

        return $str;
    }
}