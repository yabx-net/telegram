<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;
use Yabx\Telegram\ObjectTrait;

abstract class InputMedia {

    use ObjectTrait;

    public static function fromArray(array $data): InputMedia {
        return match ($data['type'] ?? null) {
            'animation' => InputMediaAnimation::fromArray($data),
            'audio' => InputMediaAudio::fromArray($data),
            'document' => InputMediaDocument::fromArray($data),
            'photo' => InputMediaPhoto::fromArray($data),
            'video' => InputMediaVideo::fromArray($data),
            default => throw new Exception('Failed to create InputMedia')
        };
    }

}
