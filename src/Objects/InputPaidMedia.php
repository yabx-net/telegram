<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;


abstract class InputPaidMedia extends AbstractObject {

    public static function fromArray(array $data): InputPaidMedia {
        return match ($data['type'] ?? null) {
            'photo' => InputPaidMediaPhoto::fromArray($data),
            'video' => InputPaidMediaVideo::fromArray($data),
            'live_photo' => InputPaidMediaLivePhoto::fromArray($data),
            default => throw new Exception('Failed to create InputPaidMedia')
        };
    }
}
