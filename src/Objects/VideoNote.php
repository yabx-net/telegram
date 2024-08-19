<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class VideoNote {

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
     * Length
     *
     * Video width and height (diameter of the video message) as defined by the sender
     * @var int|null
     */
    protected ?int $length = null;

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
     * File Size
     *
     * Optional. File size in bytes
     * @var int|null
     */
    protected ?int $fileSize = null;

    public static function fromArray(array $data): VideoNote {
        $instance = new self();
        if (isset($data['file_id'])) {
            $instance->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $instance->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['length'])) {
            $instance->length = $data['length'];
        }
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        if (isset($data['thumbnail'])) {
            $instance->thumbnail = PhotoSize::fromArray($data['thumbnail']);
        }
        if (isset($data['file_size'])) {
            $instance->fileSize = $data['file_size'];
        }
        return $instance;
    }

    public function __construct(
        ?string    $fileId = null,
        ?string    $fileUniqueId = null,
        ?int       $length = null,
        ?int       $duration = null,
        ?PhotoSize $thumbnail = null,
        ?int       $fileSize = null,
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->length = $length;
        $this->duration = $duration;
        $this->thumbnail = $thumbnail;
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

    public function getLength(): ?int {
        return $this->length;
    }

    public function setLength(?int $value): self {
        $this->length = $value;
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

    public function getFileSize(): ?int {
        return $this->fileSize;
    }

    public function setFileSize(?int $value): self {
        $this->fileSize = $value;
        return $this;
    }

}
