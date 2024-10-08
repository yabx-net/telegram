<?php

namespace Yabx\Telegram\Objects;

final class ForumTopicEdited extends AbstractObject {

    /**
     * Name
     *
     * Optional. New name of the topic, if it was edited
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Icon Custom Emoji Id
     *
     * Optional. New identifier of the custom emoji shown as the topic icon, if it was edited; an empty string if the icon was removed
     * @var string|null
     */
    protected ?string $iconCustomEmojiId = null;

    public function __construct(
        ?string $name = null,
        ?string $iconCustomEmojiId = null,
    ) {
        $this->name = $name;
        $this->iconCustomEmojiId = $iconCustomEmojiId;
    }

    public static function fromArray(array $data): ForumTopicEdited {
        $instance = new self();
        if (isset($data['name'])) {
            $instance->name = $data['name'];
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

    public function getIconCustomEmojiId(): ?string {
        return $this->iconCustomEmojiId;
    }

    public function setIconCustomEmojiId(?string $value): self {
        $this->iconCustomEmojiId = $value;
        return $this;
    }

}
