<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class File {

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

    public static function fromArray(array $data): File {
        $instance = new self();
        if (isset($data['file_id'])) {
            $instance->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $instance->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['file_size'])) {
            $instance->fileSize = $data['file_size'];
        }
        if (isset($data['file_path'])) {
            $instance->filePath = $data['file_path'];
        }
        return $instance;
    }

    public function __construct(
        ?string $fileId = null,
        ?string $fileUniqueId = null,
        ?int    $fileSize = null,
        ?string $filePath = null,
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->fileSize = $fileSize;
        $this->filePath = $filePath;
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

    public function getFileSize(): ?int {
        return $this->fileSize;
    }

    public function setFileSize(?int $value): self {
        $this->fileSize = $value;
        return $this;
    }

    public function getFilePath(): ?string {
        return $this->filePath;
    }

    public function setFilePath(?string $value): self {
        $this->filePath = $value;
        return $this;
    }

}
