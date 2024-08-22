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

    public static function checkAuthorization(array $authData, string $token): array {
        $checkHash = $authData['hash'];
        unset($authData['hash']);
        $dataCheckArr = [];
        foreach ($authData as $key => $value) {
            $dataCheckArr[] = $key . '=' . $value;
        }
        sort($dataCheckArr);
        $data_check_string = implode("\n", $dataCheckArr);
        $secret_key = hash('sha256', $token, true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);
        if (strcmp($hash, $checkHash) !== 0) {
            throw new Exception('Data is NOT from Telegram');
        }
        if ((time() - $authData['auth_date']) > 86400) {
            throw new Exception('Data is outdated');
        }
        return $authData;
    }

}
