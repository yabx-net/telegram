<?php

namespace Yabx\Telegram\Objects;

/**
 * Represents the content of a message with an HTML widget to be sent as the result of an inline query. Currently, widgets can't be sent in response to inline queries in the production environment.
 * @link https://core.telegram.org/bots/api#inputwidgetmessagecontent
 */
class InputWidgetMessageContent extends InputMessageContent {

    /**
     * Html
     *
     * HTML code of the widget, 1-32768 bytes. The code must not exceed 4096 bytes when compressed by zlib with the maximum compression level.
     * @var string|null
     */
    protected ?string $html = null;

    /**
     * Width
     *
     * Optional. Width of the widget in logical pixels
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Optional. Height of the widget in logical pixels
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Public Data
     *
     * Optional. Public data of the widget, 0-1024 bytes
     * @var string|null
     */
    protected ?string $publicData = null;

    /**
     * Chat Data
     *
     * Optional. Data of the widget, which is specific to the message, 0-1024 bytes
     * @var string|null
     */
    protected ?string $chatData = null;

    /**
     * Caption
     *
     * Optional. Widget caption, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the widget caption
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Caption Entities
     *
     * Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @var array|null
     */
    protected ?array $captionEntities = null;

    /**
     * Show Caption Above Media
     *
     * Optional. Pass True if the caption must be shown above the widget
     * @var bool|null
     */
    protected ?bool $showCaptionAboveMedia = null;

    /**
     * Allow Queries
     *
     * Optional. Pass True to allow the widget to send queries to the bot
     * @var bool|null
     */
    protected ?bool $allowQueries = null;

    /**
     * Is Shared
     *
     * Optional. Pass True to create a shared widget
     * @var bool|null
     */
    protected ?bool $isShared = null;

    public function __construct(
        ?string $html = null,
        ?int $width = null,
        ?int $height = null,
        ?string $publicData = null,
        ?string $chatData = null,
        ?string $caption = null,
        ?string $parseMode = null,
        ?array $captionEntities = null,
        ?bool $showCaptionAboveMedia = null,
        ?bool $allowQueries = null,
        ?bool $isShared = null
    ) {
        $this->html = $html;
        $this->width = $width;
        $this->height = $height;
        $this->publicData = $publicData;
        $this->chatData = $chatData;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->showCaptionAboveMedia = $showCaptionAboveMedia;
        $this->allowQueries = $allowQueries;
        $this->isShared = $isShared;
    }

    public static function fromArray(array $data): InputWidgetMessageContent {
        $instance = new self();
        if (isset($data['html'])) {
            $instance->html = $data['html'];
        }
        if (isset($data['width'])) {
            $instance->width = $data['width'];
        }
        if (isset($data['height'])) {
            $instance->height = $data['height'];
        }
        if (isset($data['public_data'])) {
            $instance->publicData = $data['public_data'];
        }
        if (isset($data['chat_data'])) {
            $instance->chatData = $data['chat_data'];
        }
        if (isset($data['caption'])) {
            $instance->caption = $data['caption'];
        }
        if (isset($data['parse_mode'])) {
            $instance->parseMode = $data['parse_mode'];
        }
        if (isset($data['caption_entities'])) {
            $instance->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $instance->captionEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['show_caption_above_media'])) {
            $instance->showCaptionAboveMedia = $data['show_caption_above_media'];
        }
        if (isset($data['allow_queries'])) {
            $instance->allowQueries = $data['allow_queries'];
        }
        if (isset($data['is_shared'])) {
            $instance->isShared = $data['is_shared'];
        }
        return $instance;
    }

    public function getHtml(): ?string {
        return $this->html;
    }

    public function setHtml(?string $value): self {
        $this->html = $value;
        return $this;
    }

    public function getWidth(): ?int {
        return $this->width;
    }

    public function setWidth(?int $value): self {
        $this->width = $value;
        return $this;
    }

    public function getHeight(): ?int {
        return $this->height;
    }

    public function setHeight(?int $value): self {
        $this->height = $value;
        return $this;
    }

    public function getPublicData(): ?string {
        return $this->publicData;
    }

    public function setPublicData(?string $value): self {
        $this->publicData = $value;
        return $this;
    }

    public function getChatData(): ?string {
        return $this->chatData;
    }

    public function setChatData(?string $value): self {
        $this->chatData = $value;
        return $this;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function setCaption(?string $value): self {
        $this->caption = $value;
        return $this;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function setParseMode(?string $value): self {
        $this->parseMode = $value;
        return $this;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function setCaptionEntities(?array $value): self {
        $this->captionEntities = $value;
        return $this;
    }

    public function getShowCaptionAboveMedia(): ?bool {
        return $this->showCaptionAboveMedia;
    }

    public function setShowCaptionAboveMedia(?bool $value): self {
        $this->showCaptionAboveMedia = $value;
        return $this;
    }

    public function getAllowQueries(): ?bool {
        return $this->allowQueries;
    }

    public function setAllowQueries(?bool $value): self {
        $this->allowQueries = $value;
        return $this;
    }

    public function getIsShared(): ?bool {
        return $this->isShared;
    }

    public function setIsShared(?bool $value): self {
        $this->isShared = $value;
        return $this;
    }
}
