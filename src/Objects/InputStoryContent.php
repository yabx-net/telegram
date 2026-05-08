<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object describes the content of a story to post. Currently, it can be one of
 * @link https://core.telegram.org/bots/api#inputstorycontent
 */
abstract class InputStoryContent extends AbstractObject {

    public static function fromArray(array $data): InputStoryContent {
        return match ($data['type'] ?? null) {
            'photo' => InputStoryContentPhoto::fromArray($data),
            'video' => InputStoryContentVideo::fromArray($data),
            default => throw new InvalidArgumentException('Invalid InputStoryContent type'),
        };
    }

}
