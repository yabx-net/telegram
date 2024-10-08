<?php

namespace Yabx\Telegram\Objects;

final class ForumTopicClosed extends AbstractObject {

    public static function fromArray(array $data): ForumTopicClosed {
        return new self();
    }

}
