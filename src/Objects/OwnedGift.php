<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object describes a gift received and owned by a user or a chat. Currently, it can be one of
 * @link https://core.telegram.org/bots/api#ownedgift
 */
abstract class OwnedGift extends AbstractObject {

    public static function fromArray(array $data): OwnedGift {
        return match ($data['type'] ?? null) {
            'regular' => OwnedGiftRegular::fromArray($data),
            'unique' => OwnedGiftUnique::fromArray($data),
            default => throw new InvalidArgumentException('Invalid OwnedGift type'),
        };
    }

}
