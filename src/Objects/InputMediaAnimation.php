<?php

namespace Yabx\Telegram\Objects;

final class InputMediaAnimation extends AbstractObject {

    /**
     * Type
     *
     * Type of the result, must be animation
     * @var string
     */
    protected string $type = 'animation';

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files »
     * @var string|null
     */
    protected ?string $media = null;

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
     * Optional. Caption of the animation to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the animation caption. See formatting options for more details.
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
     * Width
     *
     * Optional. Animation width
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Optional. Animation height
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Duration
     *
     * Optional. Animation duration in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    /**
     * Has Spoiler
     *
     * Optional. Pass True if the animation needs to be covered with a spoiler animation
     * @var bool|null
     */
    protected ?bool $hasSpoiler = null;

    public function __construct(
        ?string $media = null,
        ?string $thumbnail = null,
        ?string $caption = null,
        ?string $parseMode = null,
        ?array  $captionEntities = null,
        ?bool   $showCaptionAboveMedia = null,
        ?int    $width = null,
        ?int    $height = null,
        ?int    $duration = null,
        ?bool   $hasSpoiler = null,
    ) {
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->showCaptionAboveMedia = $showCaptionAboveMedia;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->hasSpoiler = $hasSpoiler;
    }

    public static function fromArray(array $data): InputMediaAnimation {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['media'])) {
            $instance->media = $data['media'];
        }
        if (isset($data['thumbnail'])) {
            $instance->thumbnail = $data['thumbnail'];
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
        if (isset($data['width'])) {
            $instance->width = $data['width'];
        }
        if (isset($data['height'])) {
            $instance->height = $data['height'];
        }
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        if (isset($data['has_spoiler'])) {
            $instance->hasSpoiler = $data['has_spoiler'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMedia(): ?string {
        return $this->media;
    }

    public function setMedia(?string $value): self {
        $this->media = $value;
        return $this;
    }

    public function getThumbnail(): ?string {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $value): self {
        $this->thumbnail = $value;
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

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(?int $value): self {
        $this->duration = $value;
        return $this;
    }

    public function getHasSpoiler(): ?bool {
        return $this->hasSpoiler;
    }

    public function setHasSpoiler(?bool $value): self {
        $this->hasSpoiler = $value;
        return $this;
    }

}
