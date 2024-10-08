<?php

namespace Yabx\Telegram\Objects;

final class ForumTopicReopened extends AbstractObject {

    public static function fromArray(array $data): ForumTopicReopened {
        return new self();
    }

}
