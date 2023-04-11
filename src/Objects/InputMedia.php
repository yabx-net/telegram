<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InputMedia {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): InputMedia {
        $instance = new self();
        return $instance;
    }

}
