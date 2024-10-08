<?php

namespace Yabx\Telegram\Objects;

final class Audio extends AbstractObject {

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
     * Duration
     *
     * Duration of the audio in seconds as defined by the sender
     * @var int|null
     */
    protected ?int $duration = null;

    /**
     * Performer
     *
     * Optional. Performer of the audio as defined by the sender or by audio tags
     * @var string|null
     */
    protected ?string $performer = null;

    /**
     * Title
     *
     * Optional. Title of the audio as defined by the sender or by audio tags
     * @var string|null
     */
    protected ?string $title = null;

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

    /**
     * Thumbnail
     *
     * Optional. Thumbnail of the album cover to which the music file belongs
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail = null;

    public function __construct(
        ?string    $fileId = null,
        ?string    $fileUniqueId = null,
        ?int       $duration = null,
        ?string    $performer = null,
        ?string    $title = null,
        ?string    $fileName = null,
        ?string    $mimeType = null,
        ?int       $fileSize = null,
        ?PhotoSize $thumbnail = null,
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
        $this->thumbnail = $thumbnail;
    }

    public static function fromArray(array $data): Audio {
        $instance = new self();
        if (isset($data['file_id'])) {
            $instance->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $instance->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        if (isset($data['performer'])) {
            $instance->performer = $data['performer'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
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
        if (isset($data['thumbnail'])) {
            $instance->thumbnail = PhotoSize::fromArray($data['thumbnail']);
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

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(?int $value): self {
        $this->duration = $value;
        return $this;
    }

    public function getPerformer(): ?string {
        return $this->performer;
    }

    public function setPerformer(?string $value): self {
        $this->performer = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
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

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }

    public function setThumbnail(?PhotoSize $value): self {
        $this->thumbnail = $value;
        return $this;
    }

}
