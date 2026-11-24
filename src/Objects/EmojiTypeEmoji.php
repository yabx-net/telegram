<?php

namespace Yabx\Telegram\Objects;

/**
 * A regular emoji.
 * @link https://core.telegram.org/bots/api#emojitypeemoji
 */
final class EmojiTypeEmoji extends EmojiType {

    /**
     * Type
     *
     * Type of the object, always "emoji"
     * @var string
     */
    protected string $type = 'emoji';

    /**
     * Emoji
     *
     * The emoji
     * @var string|null
     */
    protected ?string $emoji = null;

    public function __construct(
        ?string $emoji = null
    ) {
        $this->emoji = $emoji;
    }

    public static function fromArray(array $data): EmojiTypeEmoji {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['emoji'])) {
            $instance->emoji = $data['emoji'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getEmoji(): ?string {
        return $this->emoji;
    }

    public function setEmoji(?string $value): self {
        $this->emoji = $value;
        return $this;
    }
}
