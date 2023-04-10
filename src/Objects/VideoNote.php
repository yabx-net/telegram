<?php

namespace Yabx\Telegram\Objects;

class VideoNote {

    /**
     * File Id
     *
     * Identifier for this file, which can be used to download or reuse the file
     * @var string
     */
    protected string $fileId;

    /**
     * File Unique Id
     *
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string
     */
    protected string $fileUniqueId;

    /**
     * Length
     *
     * Video width and height (diameter of the video message) as defined by sender
     * @var int
     */
    protected int $length;

    /**
     * Duration
     *
     * Duration of the video in seconds as defined by sender
     * @var int
     */
    protected int $duration;

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


    public function __construct(array $data) {
        if (isset($data['file_id'])) {
            $this->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $this->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['length'])) {
            $this->length = $data['length'];
        }
        if (isset($data['duration'])) {
            $this->duration = $data['duration'];
        }
        if (isset($data['thumbnail'])) {
            $this->thumbnail = new PhotoSize($data['thumbnail']);
        }
        if (isset($data['file_size'])) {
            $this->fileSize = $data['file_size'];
        }
    }

    public function getFileId(): string {
        return $this->fileId;
    }

    public function getFileUniqueId(): string {
        return $this->fileUniqueId;
    }

    public function getLength(): int {
        return $this->length;
    }

    public function getDuration(): int {
        return $this->duration;
    }

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }

    public function getFileSize(): ?int {
        return $this->fileSize;
    }


}
