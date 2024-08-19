<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ForumTopic {

    use ObjectTrait;

    /**
     * Message Thread Id
     *
     * Unique identifier of the forum topic
     * @var int|null
     */
    protected ?int $messageThreadId = null;

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

    public static function fromArray(array $data): ForumTopic {
        $instance = new self();
        if (isset($data['message_thread_id'])) {
            $instance->messageThreadId = $data['message_thread_id'];
        }
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

    public function __construct(
        ?int    $messageThreadId = null,
        ?string $name = null,
        ?int    $iconColor = null,
        ?string $iconCustomEmojiId = null,
    ) {
        $this->messageThreadId = $messageThreadId;
        $this->name = $name;
        $this->iconColor = $iconColor;
        $this->iconCustomEmojiId = $iconCustomEmojiId;
    }

    public function getMessageThreadId(): ?int {
        return $this->messageThreadId;
    }

    public function setMessageThreadId(?int $value): self {
        $this->messageThreadId = $value;
        return $this;
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
