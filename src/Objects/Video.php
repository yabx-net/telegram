<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Video {

    use ObjectTrait;

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
     * Video width as defined by the sender
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Video height as defined by the sender
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Duration
     *
     * Duration of the video in seconds as defined by the sender
     * @var int|null
     */
    protected ?int $duration = null;

    /**
     * Thumbnail
     *
     * Optional. Video thumbnail
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail = null;

    /**
     * File Name
     *
     * Optional. Original filename as defined by the sender
     * @var string|null
     */
    protected ?string $fileName = null;

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
     * Optional. File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
     * @var int|null
     */
    protected ?int $fileSize = null;

    public static function fromArray(array $data): Video {
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
        if (isset($data['thumbnail'])) {
            $instance->thumbnail = PhotoSize::fromArray($data['thumbnail']);
        }
        if (isset($data['file_name'])) {
            $instance->fileName = $data['file_name'];
        }
        if (isset($data['mime_type'])) {
            $instance->mimeType = $data['mime_type'];
        }
        if (isset($data['file_size'])) {
            $instance->fileSize = $data['file_size'];
        }
        return $instance;
    }

    public function __construct(
        ?string    $fileId = null,
        ?string    $fileUniqueId = null,
        ?int       $width = null,
        ?int       $height = null,
        ?int       $duration = null,
        ?PhotoSize $thumbnail = null,
        ?string    $fileName = null,
        ?string    $mimeType = null,
        ?int       $fileSize = null,
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->thumbnail = $thumbnail;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
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

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }

    public function setThumbnail(?PhotoSize $value): self {
        $this->thumbnail = $value;
        return $this;
    }

    public function getFileName(): ?string {
        return $this->fileName;
    }

    public function setFileName(?string $value): self {
        $this->fileName = $value;
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
