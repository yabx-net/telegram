<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MenuButton {

    use ObjectTrait;

    public static function fromArray(array $data): MenuButton {
        return new self();
    }

}
