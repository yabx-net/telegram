<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InlineQueryResultGif {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the result, must be gif
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 bytes
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Gif Url
     *
     * A valid URL for the GIF file. File size must not exceed 1MB
     * @var string|null
     */
    protected ?string $gifUrl = null;

    /**
     * Gif Width
     *
     * Optional. Width of the GIF
     * @var int|null
     */
    protected ?int $gifWidth = null;

    /**
     * Gif Height
     *
     * Optional. Height of the GIF
     * @var int|null
     */
    protected ?int $gifHeight = null;

    /**
     * Gif Duration
     *
     * Optional. Duration of the GIF in seconds
     * @var int|null
     */
    protected ?int $gifDuration = null;

    /**
     * Thumbnail Url
     *
     * URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result
     * @var string|null
     */
    protected ?string $thumbnailUrl = null;

    /**
     * Thumbnail Mime Type
     *
     * Optional. MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or “video/mp4”. Defaults to “image/jpeg”
     * @var string|null
     */
    protected ?string $thumbnailMimeType = null;

    /**
     * Title
     *
     * Optional. Title for the result
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Caption
     *
     * Optional. Caption of the GIF file to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the caption. See formatting options for more details.
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Caption Entities
     *
     * Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @var MessageEntity[]|null
     */
    protected ?array $captionEntities = null;

    /**
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;

    /**
     * Input Message Content
     *
     * Optional. Content of the message to be sent instead of the GIF animation
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $gifUrl = null,
        ?int                  $gifWidth = null,
        ?int                  $gifHeight = null,
        ?int                  $gifDuration = null,
        ?string               $thumbnailUrl = null,
        ?string               $thumbnailMimeType = null,
        ?string               $title = null,
        ?string               $caption = null,
        ?string               $parseMode = null,
        ?array                $captionEntities = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->gifUrl = $gifUrl;
        $this->gifWidth = $gifWidth;
        $this->gifHeight = $gifHeight;
        $this->gifDuration = $gifDuration;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailMimeType = $thumbnailMimeType;
        $this->title = $title;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
    }

    public static function fromArray(array $data): InlineQueryResultGif {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['gif_url'])) {
            $instance->gifUrl = $data['gif_url'];
        }
        if (isset($data['gif_width'])) {
            $instance->gifWidth = $data['gif_width'];
        }
        if (isset($data['gif_height'])) {
            $instance->gifHeight = $data['gif_height'];
        }
        if (isset($data['gif_duration'])) {
            $instance->gifDuration = $data['gif_duration'];
        }
        if (isset($data['thumbnail_url'])) {
            $instance->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_mime_type'])) {
            $instance->thumbnailMimeType = $data['thumbnail_mime_type'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
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
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $instance->inputMessageContent = InputMessageContent::fromArray($data['input_message_content']);
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

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getGifUrl(): ?string {
        return $this->gifUrl;
    }

    public function setGifUrl(?string $value): self {
        $this->gifUrl = $value;
        return $this;
    }

    public function getGifWidth(): ?int {
        return $this->gifWidth;
    }

    public function setGifWidth(?int $value): self {
        $this->gifWidth = $value;
        return $this;
    }

    public function getGifHeight(): ?int {
        return $this->gifHeight;
    }

    public function setGifHeight(?int $value): self {
        $this->gifHeight = $value;
        return $this;
    }

    public function getGifDuration(): ?int {
        return $this->gifDuration;
    }

    public function setGifDuration(?int $value): self {
        $this->gifDuration = $value;
        return $this;
    }

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $value): self {
        $this->thumbnailUrl = $value;
        return $this;
    }

    public function getThumbnailMimeType(): ?string {
        return $this->thumbnailMimeType;
    }

    public function setThumbnailMimeType(?string $value): self {
        $this->thumbnailMimeType = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
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

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $value): self {
        $this->replyMarkup = $value;
        return $this;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function setInputMessageContent(?InputMessageContent $value): self {
        $this->inputMessageContent = $value;
        return $this;
    }

}
