<?php

namespace Yabx\Telegram\Objects;

class PassportFile {

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
     * File size in bytes
     * @var int
     */
    protected int $fileSize;

    /**
     * File Date
     *
     * Unix time when the file was uploaded
     * @var int
     */
    protected int $fileDate;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['file_id'])) {
            $this->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $this->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['file_size'])) {
            $this->fileSize = $data['file_size'];
        }
        if (isset($data['file_date'])) {
            $this->fileDate = $data['file_date'];
        }
    }

    public function getFileId(): string {
        return $this->fileId;
    }

    public function getFileUniqueId(): string {
        return $this->fileUniqueId;
    }

    public function getFileSize(): int {
        return $this->fileSize;
    }

    public function getFileDate(): int {
        return $this->fileDate;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
