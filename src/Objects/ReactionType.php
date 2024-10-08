<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;


abstract class ReactionType extends AbstractObject {

    public static function fromArray(array $data): ReactionType {
        return match ($data['type']) {
            'custom_emoji' => ReactionTypeCustomEmoji::fromArray($data),
            'emoji' => ReactionTypeEmoji::fromArray($data),
            'paid' => ReactionTypePaid::fromArray($data),
            default => throw new InvalidArgumentException('Invalid ReactionType'),
        };
    }

}
