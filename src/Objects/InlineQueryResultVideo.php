<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultVideo extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be video
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
     * Video Url
     *
     * A valid URL for the embedded video player or video file
     * @var string|null
     */
    protected ?string $videoUrl = null;

    /**
     * Mime Type
     *
     * MIME type of the content of the video URL, “text/html” or “video/mp4”
     * @var string|null
     */
    protected ?string $mimeType = null;

    /**
     * Thumbnail Url
     *
     * URL of the thumbnail (JPEG only) for the video
     * @var string|null
     */
    protected ?string $thumbnailUrl = null;

    /**
     * Title
     *
     * Title for the result
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Caption
     *
     * Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the video caption. See formatting options for more details.
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
     * Show Caption Above Media
     *
     * Optional. Pass True, if the caption must be shown above the message media
     * @var bool|null
     */
    protected ?bool $showCaptionAboveMedia = null;

    /**
     * Video Width
     *
     * Optional. Video width
     * @var int|null
     */
    protected ?int $videoWidth = null;

    /**
     * Video Height
     *
     * Optional. Video height
     * @var int|null
     */
    protected ?int $videoHeight = null;

    /**
     * Video Duration
     *
     * Optional. Video duration in seconds
     * @var int|null
     */
    protected ?int $videoDuration = null;

    /**
     * Description
     *
     * Optional. Short description of the result
     * @var string|null
     */
    protected ?string $description = null;

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
     * Optional. Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $videoUrl = null,
        ?string               $mimeType = null,
        ?string               $thumbnailUrl = null,
        ?string               $title = null,
        ?string               $caption = null,
        ?string               $parseMode = null,
        ?array                $captionEntities = null,
        ?bool                 $showCaptionAboveMedia = null,
        ?int                  $videoWidth = null,
        ?int                  $videoHeight = null,
        ?int                  $videoDuration = null,
        ?string               $description = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->videoUrl = $videoUrl;
        $this->mimeType = $mimeType;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->title = $title;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->showCaptionAboveMedia = $showCaptionAboveMedia;
        $this->videoWidth = $videoWidth;
        $this->videoHeight = $videoHeight;
        $this->videoDuration = $videoDuration;
        $this->description = $description;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
    }

    public static function fromArray(array $data): InlineQueryResultVideo {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['video_url'])) {
            $instance->videoUrl = $data['video_url'];
        }
        if (isset($data['mime_type'])) {
            $instance->mimeType = $data['mime_type'];
        }
        if (isset($data['thumbnail_url'])) {
            $instance->thumbnailUrl = $data['thumbnail_url'];
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
        if (isset($data['show_caption_above_media'])) {
            $instance->showCaptionAboveMedia = $data['show_caption_above_media'];
        }
        if (isset($data['video_width'])) {
            $instance->videoWidth = $data['video_width'];
        }
        if (isset($data['video_height'])) {
            $instance->videoHeight = $data['video_height'];
        }
        if (isset($data['video_duration'])) {
            $instance->videoDuration = $data['video_duration'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
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

    public function getVideoUrl(): ?string {
        return $this->videoUrl;
    }

    public function setVideoUrl(?string $value): self {
        $this->videoUrl = $value;
        return $this;
    }

    public function getMimeType(): ?string {
        return $this->mimeType;
    }

    public function setMimeType(?string $value): self {
        $this->mimeType = $value;
        return $this;
    }

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $value): self {
        $this->thumbnailUrl = $value;
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

    public function getShowCaptionAboveMedia(): ?bool {
        return $this->showCaptionAboveMedia;
    }

    public function setShowCaptionAboveMedia(?bool $value): self {
        $this->showCaptionAboveMedia = $value;
        return $this;
    }

    public function getVideoWidth(): ?int {
        return $this->videoWidth;
    }

    public function setVideoWidth(?int $value): self {
        $this->videoWidth = $value;
        return $this;
    }

    public function getVideoHeight(): ?int {
        return $this->videoHeight;
    }

    public function setVideoHeight(?int $value): self {
        $this->videoHeight = $value;
        return $this;
    }

    public function getVideoDuration(): ?int {
        return $this->videoDuration;
    }

    public function setVideoDuration(?int $value): self {
        $this->videoDuration = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
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
