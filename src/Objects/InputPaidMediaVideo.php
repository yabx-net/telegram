<?php

namespace Yabx\Telegram\Objects;

final class InputPaidMediaVideo extends InputPaidMedia {

    /**
     * Type
     *
     * Type of the media, must be video
     * @var string|null
     */
    protected ?string $type = null;

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

    public static function fromArray(array $data): InputPaidMediaVideo {
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
        if (isset($data['width'])) {
            $instance->width = $data['width'];
        }
        if (isset($data['height'])) {
            $instance->height = $data['height'];
        }
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        if (isset($data['supports_streaming'])) {
            $instance->supportsStreaming = $data['supports_streaming'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $media = null,
        ?string $thumbnail = null,
        ?int    $width = null,
        ?int    $height = null,
        ?int    $duration = null,
        ?bool   $supportsStreaming = null,
    ) {
        $this->type = $type;
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->supportsStreaming = $supportsStreaming;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
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

    public function getSupportsStreaming(): ?bool {
        return $this->supportsStreaming;
    }

    public function setSupportsStreaming(?bool $value): self {
        $this->supportsStreaming = $value;
        return $this;
    }

}
