<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;
use Yabx\Telegram\ObjectTrait;

abstract class ReactionType {

    use ObjectTrait;

    public static function fromArray(array $data): ReactionType {
        return match ($data['type']) {
            'custom_emoji' => ReactionTypeCustomEmoji::fromArray($data),
            'emoji' => ReactionTypeEmoji::fromArray($data),
            'paid' => ReactionTypePaid::fromArray($data),
            default => throw new InvalidArgumentException('Invalid ReactionType'),
        };
    }

}
