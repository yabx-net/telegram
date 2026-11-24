<?php

namespace Yabx\Telegram\Objects;

/**
 * A custom emoji.
 * @link https://core.telegram.org/bots/api#emojitypecustomemoji
 */
final class EmojiTypeCustomEmoji extends EmojiType {

    /**
     * Type
     *
     * Type of the object, always "custom_emoji"
     * @var string
     */
    protected string $type = 'custom_emoji';

    /**
     * Custom Emoji Id
     *
     * Identifier of the custom emoji. Use getCustomEmojiStickers to get full information about the sticker.
     * @var string|null
     */
    protected ?string $customEmojiId = null;

    public function __construct(
        ?string $customEmojiId = null
    ) {
        $this->customEmojiId = $customEmojiId;
    }

    public static function fromArray(array $data): EmojiTypeCustomEmoji {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['custom_emoji_id'])) {
            $instance->customEmojiId = $data['custom_emoji_id'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getCustomEmojiId(): ?string {
        return $this->customEmojiId;
    }

    public function setCustomEmojiId(?string $value): self {
        $this->customEmojiId = $value;
        return $this;
    }
}
