<?php

namespace Yabx\Telegram\Objects;

class InputMediaVideo {

    /**
     * Type
     *
     * Type of the result, must be video
     * @var string
     */
    protected string $type;

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files »
     * @var string
     */
    protected string $media;

    /**
     * Thumbnail
     *
     * Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @var string|null
     */
    protected ?string $thumbnail = null;

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
     * Width
     *
     * Optional. Video width
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Optional. Video height
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Duration
     *
     * Optional. Video duration in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    /**
     * Supports Streaming
     *
     * Optional. Pass True if the uploaded video is suitable for streaming
     * @var bool|null
     */
    protected ?bool $supportsStreaming = null;

    /**
     * Has Spoiler
     *
     * Optional. Pass True if the video needs to be covered with a spoiler animation
     * @var bool|null
     */
    protected ?bool $hasSpoiler = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['media'])) {
            $this->media = $data['media'];
        }
        if (isset($data['thumbnail'])) {
            $this->thumbnail = $data['thumbnail'];
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
        if (isset($data['width'])) {
            $this->width = $data['width'];
        }
        if (isset($data['height'])) {
            $this->height = $data['height'];
        }
        if (isset($data['duration'])) {
            $this->duration = $data['duration'];
        }
        if (isset($data['supports_streaming'])) {
            $this->supportsStreaming = $data['supports_streaming'];
        }
        if (isset($data['has_spoiler'])) {
            $this->hasSpoiler = $data['has_spoiler'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMedia(): string {
        return $this->media;
    }

    public function getThumbnail(): ?string {
        return $this->thumbnail;
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

    public function getWidth(): ?int {
        return $this->width;
    }

    public function getHeight(): ?int {
        return $this->height;
    }

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function getSupportsStreaming(): ?bool {
        return $this->supportsStreaming;
    }

    public function getHasSpoiler(): ?bool {
        return $this->hasSpoiler;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
