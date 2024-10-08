<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MessageEntity {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the entity. Currently, can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “spoiler” (spoiler message), “blockquote” (block quotation), “expandable_blockquote” (collapsed-by-default block quotation), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers)
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Offset
     *
     * Offset in UTF-16 code units to the start of the entity
     * @var int|null
     */
    protected ?int $offset = null;

    /**
     * Length
     *
     * Length of the entity in UTF-16 code units
     * @var int|null
     */
    protected ?int $length = null;

    /**
     * Url
     *
     * Optional. For “text_link” only, URL that will be opened after user taps on the text
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * User
     *
     * Optional. For “text_mention” only, the mentioned user
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Language
     *
     * Optional. For “pre” only, the programming language of the entity text
     * @var string|null
     */
    protected ?string $language = null;

    /**
     * Custom Emoji Id
     *
     * Optional. For “custom_emoji” only, unique identifier of the custom emoji. Use getCustomEmojiStickers to get full information about the sticker
     * @var string|null
     */
    protected ?string $customEmojiId = null;

    public function __construct(
        ?string $type = null,
        ?int    $offset = null,
        ?int    $length = null,
        ?string $url = null,
        ?User   $user = null,
        ?string $language = null,
        ?string $customEmojiId = null,
    ) {
        $this->type = $type;
        $this->offset = $offset;
        $this->length = $length;
        $this->url = $url;
        $this->user = $user;
        $this->language = $language;
        $this->customEmojiId = $customEmojiId;
    }

    public static function fromArray(array $data): MessageEntity {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['offset'])) {
            $instance->offset = $data['offset'];
        }
        if (isset($data['length'])) {
            $instance->length = $data['length'];
        }
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['language'])) {
            $instance->language = $data['language'];
        }
        if (isset($data['custom_emoji_id'])) {
            $instance->customEmojiId = $data['custom_emoji_id'];
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

    public function getOffset(): ?int {
        return $this->offset;
    }

    public function setOffset(?int $value): self {
        $this->offset = $value;
        return $this;
    }

    public function getLength(): ?int {
        return $this->length;
    }

    public function setLength(?int $value): self {
        $this->length = $value;
        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getLanguage(): ?string {
        return $this->language;
    }

    public function setLanguage(?string $value): self {
        $this->language = $value;
        return $this;
    }

    public function getCustomEmojiId(): ?string {
        return $this->customEmojiId;
    }

    public function setCustomEmojiId(?string $value): self {
        $this->customEmojiId = $value;
        return $this;
    }

}
