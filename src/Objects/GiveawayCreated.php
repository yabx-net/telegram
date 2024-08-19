<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GiveawayCreated {

    use ObjectTrait;

    public static function fromArray(array $data): GiveawayCreated {
        return new self();
    }

}
