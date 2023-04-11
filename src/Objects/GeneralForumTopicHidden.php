<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GeneralForumTopicHidden {

    use ObjectTrait;

    public function __construct() {}

    public static function fromArray(array $data): GeneralForumTopicHidden {
        $instance = new self();
        return $instance;
    }

}
