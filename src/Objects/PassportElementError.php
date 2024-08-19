<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PassportElementError {

    use ObjectTrait;

    public static function fromArray(array $data): PassportElementError {
        return new self();
    }

}
