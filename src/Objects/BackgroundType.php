<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;
use Yabx\Telegram\ObjectTrait;

abstract class BackgroundType {

    use ObjectTrait;

    public static function fromArray(array $data): BackgroundType {
        return match ($data['type'] ?? null) {
            'chat_theme' => BackgroundTypeChatTheme::fromArray($data),
            'fill' => BackgroundTypeFill::fromArray($data),
            'pattern' => BackgroundTypePattern::fromArray($data),
            'wallpaper' => BackgroundTypeWallpaper::fromArray($data),
            default => throw new Exception('Failed to create BackgroundType')
        };
    }


}
