<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents a photo with a short video.
 * @link https://core.telegram.org/bots/api#livephoto
 */
final class LivePhoto extends AbstractObject {

    /**
     * File Id
     *
     * Identifier for this file, which can be used to download or reuse the file
     * @var string|null
     */
    protected ?string $fileId = null;

    /**
     * File Unique Id
     *
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string|null
     */
    protected ?string $fileUniqueId = null;

    /**
     * Width
     *
     * Live photo width
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Live photo height
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Duration
     *
     * Duration of the video part of the live photo in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    /**
     * Photo
     *
     * Optional. Available sizes of the photo
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    /**
     * Mime Type
     *
     * Optional. MIME type of the file as defined by the sender
     * @var string|null
     */
    protected ?string $mimeType = null;

    /**
     * File Size
     *
     * Optional. File size in bytes
     * @var int|null
     */
    protected ?int $fileSize = null;

    public function __construct(
        ?string $fileId = null,
        ?string $fileUniqueId = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?array $photo = null,
        ?string $mimeType = null,
        ?int $fileSize = null,
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->photo = $photo;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    public static function fromArray(array $data): LivePhoto {
        $instance = new self();
        if (isset($data['file_id'])) {
            $instance->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $instance->fileUniqueId = $data['file_unique_id'];
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
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        if (isset($data['mime_type'])) {
            $instance->mimeType = $data['mime_type'];
        }
        if (isset($data['file_size'])) {
            $instance->fileSize = $data['file_size'];
        }
        return $instance;
    }

    public function getFileId(): ?string {
        return $this->fileId;
    }

    public function setFileId(?string $value): self {
        $this->fileId = $value;
        return $this;
    }

    public function getFileUniqueId(): ?string {
        return $this->fileUniqueId;
    }

    public function setFileUniqueId(?string $value): self {
        $this->fileUniqueId = $value;
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

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

    public function getMimeType(): ?string {
        return $this->mimeType;
    }

    public function setMimeType(?string $value): self {
        $this->mimeType = $value;
        return $this;
    }

    public function getFileSize(): ?int {
        return $this->fileSize;
    }

    public function setFileSize(?int $value): self {
        $this->fileSize = $value;
        return $this;
    }

}
