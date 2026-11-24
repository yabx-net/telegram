<?php

namespace Yabx\Telegram\Objects;

/**
 * Represents the content of a message with a shared widget to be sent as the result of an inline query. Currently, widgets can't be sent in response to inline queries in the production environment.
 * @link https://core.telegram.org/bots/api#inputsharedwidgetmessagecontent
 */
class InputSharedWidgetMessageContent extends InputMessageContent {

    /**
     * Widget Id
     *
     * Unique identifier of the shared widget created by the bot
     * @var string|null
     */
    protected ?string $widgetId = null;

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

    public function __construct(
        ?string $widgetId = null,
        ?string $chatData = null,
        ?string $caption = null,
        ?string $parseMode = null,
        ?array $captionEntities = null,
        ?bool $showCaptionAboveMedia = null
    ) {
        $this->widgetId = $widgetId;
        $this->chatData = $chatData;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->showCaptionAboveMedia = $showCaptionAboveMedia;
    }

    public static function fromArray(array $data): InputSharedWidgetMessageContent {
        $instance = new self();
        if (isset($data['widget_id'])) {
            $instance->widgetId = $data['widget_id'];
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
        return $instance;
    }

    public function getWidgetId(): ?string {
        return $this->widgetId;
    }

    public function setWidgetId(?string $value): self {
        $this->widgetId = $value;
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
}
