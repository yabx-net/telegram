<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatMember {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): ChatMember {
        $instance = new self();
        return $instance;
    }

}
