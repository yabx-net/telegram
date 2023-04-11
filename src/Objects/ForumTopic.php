<?php

namespace Yabx\Telegram\Objects;

class ForumTopic {

    /**
     * Message Thread Id
     *
     * Unique identifier of the forum topic
     * @var int
     */
    protected int $messageThreadId;

    /**
     * Name
     *
     * Name of the topic
     * @var string
     */
    protected string $name;

    /**
     * Icon Color
     *
     * Color of the topic icon in RGB format
     * @var int
     */
    protected int $iconColor;

    /**
     * Icon Custom Emoji Id
     *
     * Optional. Unique identifier of the custom emoji shown as the topic icon
     * @var string|null
     */
    protected ?string $iconCustomEmojiId = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['message_thread_id'])) {
            $this->messageThreadId = $data['message_thread_id'];
        }
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['icon_color'])) {
            $this->iconColor = $data['icon_color'];
        }
        if (isset($data['icon_custom_emoji_id'])) {
            $this->iconCustomEmojiId = $data['icon_custom_emoji_id'];
        }
    }

    public function getMessageThreadId(): int {
        return $this->messageThreadId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getIconColor(): int {
        return $this->iconColor;
    }

    public function getIconCustomEmojiId(): ?string {
        return $this->iconCustomEmojiId;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
