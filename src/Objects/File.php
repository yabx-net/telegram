<?php

namespace Yabx\Telegram\Objects;

class File {

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
     * File Size
     *
     * Optional. File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
     * @var int|null
     */
    protected ?int $fileSize = null;

    /**
     * File Path
     *
     * Optional. File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
     * @var string|null
     */
    protected ?string $filePath = null;


    public function __construct(array $data) {
        if (isset($data['file_id'])) {
            $this->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $this->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['file_size'])) {
            $this->fileSize = $data['file_size'];
        }
        if (isset($data['file_path'])) {
            $this->filePath = $data['file_path'];
        }
    }

    public function getFileId(): string {
        return $this->fileId;
    }

    public function getFileUniqueId(): string {
        return $this->fileUniqueId;
    }

    public function getFileSize(): ?int {
        return $this->fileSize;
    }

    public function getFilePath(): ?string {
        return $this->filePath;
    }


}
