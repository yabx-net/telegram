<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * Describes the type of a clickable area on a story. Currently, it can be one of
 * @link https://core.telegram.org/bots/api#storyareatype
 */
abstract class StoryAreaType extends AbstractObject {

    public static function fromArray(array $data): StoryAreaType {
        return match ($data['type'] ?? null) {
            'link' => StoryAreaTypeLink::fromArray($data),
            'location' => StoryAreaTypeLocation::fromArray($data),
            'suggested_reaction' => StoryAreaTypeSuggestedReaction::fromArray($data),
            'unique_gift' => StoryAreaTypeUniqueGift::fromArray($data),
            'weather' => StoryAreaTypeWeather::fromArray($data),
            default => throw new InvalidArgumentException('Invalid StoryAreaType type'),
        };
    }

}
