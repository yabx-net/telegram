<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GeneralForumTopicUnhidden {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): GeneralForumTopicUnhidden {
        $instance = new self();
        return $instance;
    }

}
