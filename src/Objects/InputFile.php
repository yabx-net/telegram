<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InputFile {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): InputFile {
        $instance = new self();
        return $instance;
    }

}
