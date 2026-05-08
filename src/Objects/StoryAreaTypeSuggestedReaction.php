<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a story area pointing to a suggested reaction. Currently, a story can have up to 5 suggested reaction areas.
 * @link https://core.telegram.org/bots/api#storyareatypesuggestedreaction
 */
final class StoryAreaTypeSuggestedReaction extends StoryAreaType {

    /**
     * Type
     *
     * Type of the area, always “suggested_reaction”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Reaction Type
     *
     * Type of the reaction
     * @var ReactionType|null
     */
    protected ?ReactionType $reactionType = null;

    /**
     * Is Dark
     *
     * Optional. Pass True if the reaction area has a dark background
     * @var bool|null
     */
    protected ?bool $isDark = null;

    /**
     * Is Flipped
     *
     * Optional. Pass True if reaction area corner is flipped
     * @var bool|null
     */
    protected ?bool $isFlipped = null;

    public static function fromArray(array $data): StoryAreaTypeSuggestedReaction {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['reaction_type'])) {
            $instance->reactionType = ReactionType::fromArray($data['reaction_type']);
        }
        if (isset($data['is_dark'])) {
            $instance->isDark = $data['is_dark'];
        }
        if (isset($data['is_flipped'])) {
            $instance->isFlipped = $data['is_flipped'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?ReactionType $reactionType = null,
        ?bool $isDark = null,
        ?bool $isFlipped = null,
    ) {
        $this->type = $type;
        $this->reactionType = $reactionType;
        $this->isDark = $isDark;
        $this->isFlipped = $isFlipped;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getReactionType(): ?ReactionType {
        return $this->reactionType;
    }

    public function setReactionType(?ReactionType $value): self {
        $this->reactionType = $value;
        return $this;
    }

    public function getIsDark(): ?bool {
        return $this->isDark;
    }

    public function setIsDark(?bool $value): self {
        $this->isDark = $value;
        return $this;
    }

    public function getIsFlipped(): ?bool {
        return $this->isFlipped;
    }

    public function setIsFlipped(?bool $value): self {
        $this->isFlipped = $value;
        return $this;
    }

}
