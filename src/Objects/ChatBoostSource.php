<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatBoostSource {

    use ObjectTrait;

    public static function fromArray(array $data): ChatBoostSource {
        return new self();
    }

}
