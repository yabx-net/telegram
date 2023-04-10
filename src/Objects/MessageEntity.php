<?php

namespace Yabx\Telegram\Objects;

class MessageEntity {

    /**
     * Type
     *
     * Type of the entity. Currently, can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “spoiler” (spoiler message), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers)
     * @var string
     */
    protected string $type;

    /**
     * Offset
     *
     * Offset in UTF-16 code units to the start of the entity
     * @var int
     */
    protected int $offset;

    /**
     * Length
     *
     * Length of the entity in UTF-16 code units
     * @var int
     */
    protected int $length;

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


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['offset'])) {
            $this->offset = $data['offset'];
        }
        if (isset($data['length'])) {
            $this->length = $data['length'];
        }
        if (isset($data['url'])) {
            $this->url = $data['url'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (isset($data['language'])) {
            $this->language = $data['language'];
        }
        if (isset($data['custom_emoji_id'])) {
            $this->customEmojiId = $data['custom_emoji_id'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getOffset(): int {
        return $this->offset;
    }

    public function getLength(): int {
        return $this->length;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function getLanguage(): ?string {
        return $this->language;
    }

    public function getCustomEmojiId(): ?string {
        return $this->customEmojiId;
    }


}
