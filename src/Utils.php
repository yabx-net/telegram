<?php

namespace Yabx\Telegram;

class Utils {

    public static function toSnakeCase(string $str): string {
        preg_match_all('/[A-Z]{1}/', $str, $m);
        foreach ($m[0] as $letter) {
            $str = str_replace($letter, '_' . strtolower($letter), $str);
        }
        return trim($str, '_');
    }

    public static function toCamelCase(string $str): string {
        preg_match_all('/_([a-z]{1})/', $str, $m);
        foreach ($m[0] as $letter) {
            $str = str_replace($letter, trim(strtoupper($letter), '_'), $str);
        }
        return $str;
    }

}
