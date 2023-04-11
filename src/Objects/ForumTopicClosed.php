<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ForumTopicClosed {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): ForumTopicClosed {
        $instance = new self();
        return $instance;
    }

}
