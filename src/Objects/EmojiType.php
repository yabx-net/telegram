<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object describes an emoji. Currently, it can be one of EmojiTypeEmoji or EmojiTypeCustomEmoji.
 * @link https://core.telegram.org/bots/api#emojitype
 */
abstract class EmojiType extends AbstractObject {

    public static function fromArray(array $data): EmojiType {
        return match ($data['type'] ?? null) {
            'emoji' => EmojiTypeEmoji::fromArray($data),
            'custom_emoji' => EmojiTypeCustomEmoji::fromArray($data),
            default => throw new InvalidArgumentException('Invalid EmojiType'),
        };
    }

}
