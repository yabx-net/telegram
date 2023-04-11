<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PassportElementError {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): PassportElementError {
        $instance = new self();
        return $instance;
    }

}
