<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

abstract class ChatBoostSource extends AbstractObject {

    public static function fromArray(array $data): ChatBoostSource {
        return match ($data['source'] ?? null) {
            'premium' => ChatBoostSourcePremium::fromArray($data),
            'gift_code' => ChatBoostSourceGiftCode::fromArray($data),
            'giveaway' => ChatBoostSourceGiveaway::fromArray($data),
            default => throw new InvalidArgumentException('Invalid chat boost source'),
        };
    }

}
