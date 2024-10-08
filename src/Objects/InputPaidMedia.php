<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;


abstract class InputPaidMedia extends AbstractObject {

    public static function fromArray(array $data): InputPaidMedia {
        return match ($data['type'] ?? null) {
            'photo' => InputMediaAnimation::fromArray($data),
            'video' => InputPaidMediaVideo::fromArray($data),
            default => throw new Exception('Failed to create InputPaidMedia')
        };
    }
}
