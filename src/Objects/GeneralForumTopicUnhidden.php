<?php

namespace Yabx\Telegram\Objects;

final class GeneralForumTopicUnhidden extends AbstractObject {

    public static function fromArray(array $data): GeneralForumTopicUnhidden {
        return new self();
    }

}
