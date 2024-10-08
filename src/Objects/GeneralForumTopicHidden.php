<?php

namespace Yabx\Telegram\Objects;

final class GeneralForumTopicHidden extends AbstractObject {

    public static function fromArray(array $data): GeneralForumTopicHidden {
        return new self();
    }

}
