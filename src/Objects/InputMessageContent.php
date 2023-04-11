<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InputMessageContent {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): InputMessageContent {
        $instance = new self();
        return $instance;
    }

}
