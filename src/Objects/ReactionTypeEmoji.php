<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ReactionTypeEmoji extends ReactionType {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the reaction, always “emoji”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Emoji
     *
     * Reaction emoji. Currently, it can be one of "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""
     * @var string|null
     */
    protected ?string $emoji = null;

    public function __construct(
        ?string $type = null,
        ?string $emoji = null,
    ) {
        $this->type = $type;
        $this->emoji = $emoji;
    }

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

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getEmoji(): ?string {
        return $this->emoji;
    }

    public function setEmoji(?string $value): self {
        $this->emoji = $value;
        return $this;
    }

}
