<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MenuButton {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): MenuButton {
        $instance = new self();
        return $instance;
    }

}
