<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class WriteAccessAllowed {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): WriteAccessAllowed {
        $instance = new self();
        return $instance;
    }

}
