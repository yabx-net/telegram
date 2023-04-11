<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class CallbackGame {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): CallbackGame {
        $instance = new self();
        return $instance;
    }

}
