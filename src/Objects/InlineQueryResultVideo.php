<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultVideo {

    /**
     * Type
     *
     * Type of the result, must be video
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
     * Video Url
     *
     * A valid URL for the embedded video player or video file
     * @var string
     */
    protected string $videoUrl;

    /**
     * Mime Type
     *
     * MIME type of the content of the video URL, “text/html” or “video/mp4”
     * @var string
     */
    protected string $mimeType;

    /**
     * Thumbnail Url
     *
     * URL of the thumbnail (JPEG only) for the video
     * @var string
     */
    protected string $thumbnailUrl;

    /**
     * Title
     *
     * Title for the result
     * @var string
     */
    protected string $title;

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


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['video_url'])) {
            $this->videoUrl = $data['video_url'];
        }
        if (isset($data['mime_type'])) {
            $this->mimeType = $data['mime_type'];
        }
        if (isset($data['thumbnail_url'])) {
            $this->thumbnailUrl = $data['thumbnail_url'];
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
        if (isset($data['video_width'])) {
            $this->videoWidth = $data['video_width'];
        }
        if (isset($data['video_height'])) {
            $this->videoHeight = $data['video_height'];
        }
        if (isset($data['video_duration'])) {
            $this->videoDuration = $data['video_duration'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
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

    public function getVideoUrl(): string {
        return $this->videoUrl;
    }

    public function getMimeType(): string {
        return $this->mimeType;
    }

    public function getThumbnailUrl(): string {
        return $this->thumbnailUrl;
    }

    public function getTitle(): string {
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

    public function getVideoWidth(): ?int {
        return $this->videoWidth;
    }

    public function getVideoHeight(): ?int {
        return $this->videoHeight;
    }

    public function getVideoDuration(): ?int {
        return $this->videoDuration;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }


}
