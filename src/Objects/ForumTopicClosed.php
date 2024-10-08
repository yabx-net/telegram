<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ForumTopicClosed {

    use ObjectTrait;

    public static function fromArray(array $data): ForumTopicClosed {
        return new self();
    }

}
