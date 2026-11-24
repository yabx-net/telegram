<?php

namespace Yabx\Telegram\Objects;

/**
 * The theme with emoji placed on a background.
 * @link https://core.telegram.org/bots/api#chatsharethemeemoji
 */
final class ChatShareThemeEmoji extends ChatShareTheme {

    /**
     * Type
     *
     * Type of the object, always "emoji"
     * @var string
     */
    protected string $type = 'emoji';

    /**
     * Emojis
     *
     * The emoji; 0-6 regular or custom emoji
     * @var array|null
     */
    protected ?array $emojis = null;

    /**
     * Background Backdrop Id
     *
     * Optional. Identifier of the backdrop used as the background; omitted if the default background is used. Use getChatShareThemeBackdrops to get details about the backdrop.
     * @var int|null
     */
    protected ?int $backgroundBackdropId = null;

    public function __construct(
        ?array $emojis = null,
        ?int $backgroundBackdropId = null
    ) {
        $this->emojis = $emojis;
        $this->backgroundBackdropId = $backgroundBackdropId;
    }

    public static function fromArray(array $data): ChatShareThemeEmoji {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['emojis'])) {
            $instance->emojis = EmojiType::arrayOf($data['emojis']);
        }
        if (isset($data['background_backdrop_id'])) {
            $instance->backgroundBackdropId = $data['background_backdrop_id'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getEmojis(): ?array {
        return $this->emojis;
    }

    public function setEmojis(?array $value): self {
        $this->emojis = $value;
        return $this;
    }

    public function getBackgroundBackdropId(): ?int {
        return $this->backgroundBackdropId;
    }

    public function setBackgroundBackdropId(?int $value): self {
        $this->backgroundBackdropId = $value;
        return $this;
    }
}
