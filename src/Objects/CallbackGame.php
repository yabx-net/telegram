<?php

namespace Yabx\Telegram\Objects;

final class CallbackGame extends AbstractObject {

    public static function fromArray(array $data): CallbackGame {
        return new self();
    }

}
