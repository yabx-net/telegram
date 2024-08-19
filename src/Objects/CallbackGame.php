<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class CallbackGame {

    use ObjectTrait;

    public static function fromArray(array $data): CallbackGame {
        return new self();
    }

}
