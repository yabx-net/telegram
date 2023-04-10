<?php

namespace Yabx\Telegram\Objects;

class Document {

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
     * Thumbnail
     *
     * Optional. Document thumbnail as defined by sender
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail = null;

    /**
     * File Name
     *
     * Optional. Original filename as defined by sender
     * @var string|null
     */
    protected ?string $fileName = null;

    /**
     * Mime Type
     *
     * Optional. MIME type of the file as defined by sender
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


    public function __construct(array $data) {
        if (isset($data['file_id'])) {
            $this->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $this->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['thumbnail'])) {
            $this->thumbnail = new PhotoSize($data['thumbnail']);
        }
        if (isset($data['file_name'])) {
            $this->fileName = $data['file_name'];
        }
        if (isset($data['mime_type'])) {
            $this->mimeType = $data['mime_type'];
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

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }

    public function getFileName(): ?string {
        return $this->fileName;
    }

    public function getMimeType(): ?string {
        return $this->mimeType;
    }

    public function getFileSize(): ?int {
        return $this->fileSize;
    }


}
