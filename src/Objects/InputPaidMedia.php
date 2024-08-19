<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;
use Yabx\Telegram\ObjectTrait;

abstract class InputPaidMedia {

    use ObjectTrait;

    public static function fromArray(array $data): InputPaidMedia {
        return match ($data['type'] ?? null) {
            'photo' => InputMediaAnimation::fromArray($data),
            'video' => InputPaidMediaVideo::fromArray($data),
            default => throw new Exception('Failed to create InputPaidMedia')
        };
    }
}
