<?php

namespace Yabx\Telegram\Objects;

final class PassportFile extends AbstractObject {

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
     * File size in bytes
     * @var int|null
     */
    protected ?int $fileSize = null;

    /**
     * File Date
     *
     * Unix time when the file was uploaded
     * @var int|null
     */
    protected ?int $fileDate = null;

    public function __construct(
        ?string $fileId = null,
        ?string $fileUniqueId = null,
        ?int    $fileSize = null,
        ?int    $fileDate = null,
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->fileSize = $fileSize;
        $this->fileDate = $fileDate;
    }

    public static function fromArray(array $data): PassportFile {
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
        if (isset($data['file_date'])) {
            $instance->fileDate = $data['file_date'];
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

    public function getFileSize(): ?int {
        return $this->fileSize;
    }

    public function setFileSize(?int $value): self {
        $this->fileSize = $value;
        return $this;
    }

    public function getFileDate(): ?int {
        return $this->fileDate;
    }

    public function setFileDate(?int $value): self {
        $this->fileDate = $value;
        return $this;
    }

}
