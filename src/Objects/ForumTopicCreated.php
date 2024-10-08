<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ForumTopicCreated {

    use ObjectTrait;

    /**
     * Name
     *
     * Name of the topic
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Icon Color
     *
     * Color of the topic icon in RGB format
     * @var int|null
     */
    protected ?int $iconColor = null;

    /**
     * Icon Custom Emoji Id
     *
     * Optional. Unique identifier of the custom emoji shown as the topic icon
     * @var string|null
     */
    protected ?string $iconCustomEmojiId = null;

    public function __construct(
        ?string $name = null,
        ?int    $iconColor = null,
        ?string $iconCustomEmojiId = null,
    ) {
        $this->name = $name;
        $this->iconColor = $iconColor;
        $this->iconCustomEmojiId = $iconCustomEmojiId;
    }

    public static function fromArray(array $data): ForumTopicCreated {
        $instance = new self();
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['icon_color'])) {
            $instance->iconColor = $data['icon_color'];
        }
        if (isset($data['icon_custom_emoji_id'])) {
            $instance->iconCustomEmojiId = $data['icon_custom_emoji_id'];
        }
        return $instance;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getIconColor(): ?int {
        return $this->iconColor;
    }

    public function setIconColor(?int $value): self {
        $this->iconColor = $value;
        return $this;
    }

    public function getIconCustomEmojiId(): ?string {
        return $this->iconCustomEmojiId;
    }

    public function setIconCustomEmojiId(?string $value): self {
        $this->iconCustomEmojiId = $value;
        return $this;
    }

}
