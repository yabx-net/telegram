<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BotCommandScope {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): BotCommandScope {
        $instance = new self();
        return $instance;
    }

}
