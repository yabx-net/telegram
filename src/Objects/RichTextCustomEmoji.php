<?php

namespace Yabx\Telegram\Objects;

final class RichTextCustomEmoji extends RichText {

    protected string $type = 'custom_emoji';

    protected ?string $customEmojiId = null;

    protected ?string $alternativeText = null;

    public function __construct(
        ?string $customEmojiId = null,
        ?string $alternativeText = null
    ) {
        $this->customEmojiId = $customEmojiId;
        $this->alternativeText = $alternativeText;
    }

    public static function fromArray(array $data): RichTextCustomEmoji {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['custom_emoji_id'])) {
            $instance->customEmojiId = $data['custom_emoji_id'];
        }
        if (isset($data['alternative_text'])) {
            $instance->alternativeText = $data['alternative_text'];
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

    public function getAlternativeText(): ?string {
        return $this->alternativeText;
    }

    public function setAlternativeText(?string $value): self {
        $this->alternativeText = $value;
        return $this;
    }
}
