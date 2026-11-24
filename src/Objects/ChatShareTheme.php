<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object describes the theme of the screen for sharing a link to a user or a chat.
 * @link https://core.telegram.org/bots/api#chatsharetheme
 */
abstract class ChatShareTheme extends AbstractObject {

    public static function fromArray(array $data): ChatShareTheme {
        return match ($data['type'] ?? null) {
            'emoji' => ChatShareThemeEmoji::fromArray($data),
            'unique_gift' => ChatShareThemeUniqueGift::fromArray($data),
            default => throw new InvalidArgumentException('Invalid ChatShareTheme'),
        };
    }

}
