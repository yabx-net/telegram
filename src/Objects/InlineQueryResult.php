<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InlineQueryResult {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): InlineQueryResult {
        $instance = new self();
        return $instance;
    }

}
