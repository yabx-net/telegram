<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ForumTopicReopened {

    use ObjectTrait;

    public static function fromArray(array $data): ForumTopicReopened {
        return new self();
    }

}
