<?php

namespace Yabx\Telegram\Objects;

class ForumTopicEdited {

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


    public function __construct(array $data) {
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['icon_custom_emoji_id'])) {
            $this->iconCustomEmojiId = $data['icon_custom_emoji_id'];
        }
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getIconCustomEmojiId(): ?string {
        return $this->iconCustomEmojiId;
    }


}
