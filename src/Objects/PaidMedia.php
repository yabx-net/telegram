<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;
use Yabx\Telegram\ObjectTrait;

abstract class PaidMedia {

    use ObjectTrait;

    public static function fromArray(array $data): PaidMedia {
        return match ($data['type']) {
            'preview' => PaidMediaPreview::fromArray($data),
            'photo' => PaidMediaPhoto::fromArray($data),
            'video' => PaidMediaVideo::fromArray($data),
            default => throw new InvalidArgumentException('Invalid PaidMedia type'),
        };
    }


}
