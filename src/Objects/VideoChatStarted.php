<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class VideoChatStarted {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): VideoChatStarted {
        $instance = new self();
        return $instance;
    }

}
