<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GeneralForumTopicHidden {

    use ObjectTrait;

    public static function fromArray(array $data): GeneralForumTopicHidden {
        return new self();
    }

}
