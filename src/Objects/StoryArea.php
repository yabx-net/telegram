<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a clickable area on a story media.
 * @link https://core.telegram.org/bots/api#storyarea
 */
final class StoryArea extends AbstractObject {

    /**
     * Position
     *
     * Position of the area
     * @var StoryAreaPosition|null
     */
    protected ?StoryAreaPosition $position = null;

    /**
     * Type
     *
     * Type of the area
     * @var StoryAreaType|null
     */
    protected ?StoryAreaType $type = null;

    public static function fromArray(array $data): StoryArea {
        $instance = new self();
        if (isset($data['position'])) {
            $instance->position = StoryAreaPosition::fromArray($data['position']);
        }
        if (isset($data['type'])) {
            $instance->type = StoryAreaType::fromArray($data['type']);
        }
        return $instance;
    }

    public function __construct(
        ?StoryAreaPosition $position = null,
        ?StoryAreaType $type = null,
    ) {
        $this->position = $position;
        $this->type = $type;
    }

    public function getPosition(): ?StoryAreaPosition {
        return $this->position;
    }

    public function setPosition(?StoryAreaPosition $value): self {
        $this->position = $value;
        return $this;
    }

    public function getType(): ?StoryAreaType {
        return $this->type;
    }

    public function setType(?StoryAreaType $value): self {
        $this->type = $value;
        return $this;
    }

}
