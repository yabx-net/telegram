<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ForumTopicReopened {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): ForumTopicReopened {
        $instance = new self();
        return $instance;
    }

}
