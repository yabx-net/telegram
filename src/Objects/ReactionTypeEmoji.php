<?php

namespace Yabx\Telegram\Objects;

final class ReactionTypeEmoji extends ReactionType {

    /**
     * Type
     *
     * Type of the reaction, always “emoji”
     * @var string
     */
    protected string $type = 'emoji';

    /**
     * Emoji
     *
     * Reaction emoji.
     * @var string|null
     */
    protected ?string $emoji = null;

    public static function fromArray(array $data): ReactionTypeEmoji {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['emoji'])) {
            $instance->emoji = $data['emoji'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $emoji = null,
    ) {
        $this->type = $type;
        $this->emoji = $emoji;
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
