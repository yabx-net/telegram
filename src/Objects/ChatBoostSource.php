<?php

namespace Yabx\Telegram\Objects;

final class ChatBoostSource extends AbstractObject {

    public static function fromArray(array $data): ChatBoostSource {
        return new self();
    }

}
