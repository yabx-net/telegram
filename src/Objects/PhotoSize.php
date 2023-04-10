<?php

namespace Yabx\Telegram\Objects;

class PhotoSize {

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
     * Width
     *
     * Photo width
     * @var int
     */
    protected int $width;

    /**
     * Height
     *
     * Photo height
     * @var int
     */
    protected int $height;

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
        if (isset($data['width'])) {
            $this->width = $data['width'];
        }
        if (isset($data['height'])) {
            $this->height = $data['height'];
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

    public function getWidth(): int {
        return $this->width;
    }

    public function getHeight(): int {
        return $this->height;
    }

    public function getFileSize(): ?int {
        return $this->fileSize;
    }


}
