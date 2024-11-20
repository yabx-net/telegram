<?php

namespace Yabx\Telegram\Objects;

final class ReactionTypeCustomEmoji extends ReactionType {

    /**
     * Type
     *
     * Type of the reaction, always “custom_emoji”
     * @var string
     */
    protected string $type = 'custom_emoji';

    /**
     * Custom Emoji Id
     *
     * Custom emoji identifier
     * @var string|null
     */
    protected ?string $customEmojiId = null;

    public static function fromArray(array $data): ReactionTypeCustomEmoji {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['custom_emoji_id'])) {
            $instance->customEmojiId = $data['custom_emoji_id'];
        }
        return $instance;
    }

    public function __construct(
        ?string $customEmojiId = null,
    ) {
        $this->customEmojiId = $customEmojiId;
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
