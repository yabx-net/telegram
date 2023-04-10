<?php

namespace Yabx\Telegram;

use Exception;
use Yabx\Telegram\Objects\Update;

class Service {

    public static function fromRequest(): Update {
        if($body = file_get_contents('php://input')) {
            return self::fromJson($body);
        } else {
            throw new Exception('Empty body');
        }
    }

    /**
     * @throws Exception
     */
    public static function fromJson(string $json): Update {
        if($data = json_decode($json, true)) {
            return new Update($data);
        } else {
            throw new Exception('Malformed JSON: ' . json_last_error_msg());
        }
    }

}
