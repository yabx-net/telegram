<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a story area pointing to a unique gift. Currently, a story can have at most 1 unique gift area.
 * @link https://core.telegram.org/bots/api#storyareatypeuniquegift
 */
final class StoryAreaTypeUniqueGift extends StoryAreaType {

    /**
     * Type
     *
     * Type of the area, always “unique_gift”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Name
     *
     * Unique name of the gift
     * @var string|null
     */
    protected ?string $name = null;

    public static function fromArray(array $data): StoryAreaTypeUniqueGift {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $name = null,
    ) {
        $this->type = $type;
        $this->name = $name;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

}
