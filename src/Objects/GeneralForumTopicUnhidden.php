<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GeneralForumTopicUnhidden {

    use ObjectTrait;

    public static function fromArray(array $data): GeneralForumTopicUnhidden {
        return new self();
    }

}
