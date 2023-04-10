<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultGif {

    /**
     * Type
     *
     * Type of the result, must be gif
     * @var string
     */
    protected string $type;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 bytes
     * @var string
     */
    protected string $id;

    /**
     * Gif Url
     *
     * A valid URL for the GIF file. File size must not exceed 1MB
     * @var string
     */
    protected string $gifUrl;

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
     * @var string
     */
    protected string $thumbnailUrl;

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


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['gif_url'])) {
            $this->gifUrl = $data['gif_url'];
        }
        if (isset($data['gif_width'])) {
            $this->gifWidth = $data['gif_width'];
        }
        if (isset($data['gif_height'])) {
            $this->gifHeight = $data['gif_height'];
        }
        if (isset($data['gif_duration'])) {
            $this->gifDuration = $data['gif_duration'];
        }
        if (isset($data['thumbnail_url'])) {
            $this->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_mime_type'])) {
            $this->thumbnailMimeType = $data['thumbnail_mime_type'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }
        if (isset($data['parse_mode'])) {
            $this->parseMode = $data['parse_mode'];
        }
        if (isset($data['caption_entities'])) {
            $this->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $this->captionEntities[] = new MessageEntity($item);
            }
        }
        if (isset($data['reply_markup'])) {
            $this->replyMarkup = new InlineKeyboardMarkup($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $this->inputMessageContent = new InputMessageContent($data['input_message_content']);
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getGifUrl(): string {
        return $this->gifUrl;
    }

    public function getGifWidth(): ?int {
        return $this->gifWidth;
    }

    public function getGifHeight(): ?int {
        return $this->gifHeight;
    }

    public function getGifDuration(): ?int {
        return $this->gifDuration;
    }

    public function getThumbnailUrl(): string {
        return $this->thumbnailUrl;
    }

    public function getThumbnailMimeType(): ?string {
        return $this->thumbnailMimeType;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }


}
