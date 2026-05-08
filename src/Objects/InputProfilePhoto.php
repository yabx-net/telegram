<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object describes a profile photo to set. Currently, it can be one of
 * @link https://core.telegram.org/bots/api#inputprofilephoto
 */
abstract class InputProfilePhoto extends AbstractObject {

    public static function fromArray(array $data): InputProfilePhoto {
        return match ($data['type'] ?? null) {
            'static' => InputProfilePhotoStatic::fromArray($data),
            'animated' => InputProfilePhotoAnimated::fromArray($data),
            default => throw new InvalidArgumentException('Invalid InputProfilePhoto type'),
        };
    }

}
