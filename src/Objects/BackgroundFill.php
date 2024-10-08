<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;

abstract class BackgroundFill extends AbstractObject {

    public static function fromArray(array $data): BackgroundFill {
        return match ($data['type'] ?? null) {
            'freeform_gradient' => BackgroundFillFreeformGradient::fromArray($data),
            'gradient' => BackgroundFillGradient::fromArray($data),
            'solid' => BackgroundFillSolid::fromArray($data),
            default => throw new Exception('Failed to create BackgroundFill')
        };
    }

}
