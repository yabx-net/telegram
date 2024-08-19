<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatPhoto {

    use ObjectTrait;

    /**
     * Small File Id
     *
     * File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     * @var string|null
     */
    protected ?string $smallFileId = null;

    /**
     * Small File Unique Id
     *
     * Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string|null
     */
    protected ?string $smallFileUniqueId = null;

    /**
     * Big File Id
     *
     * File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     * @var string|null
     */
    protected ?string $bigFileId = null;

    /**
     * Big File Unique Id
     *
     * Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string|null
     */
    protected ?string $bigFileUniqueId = null;

    public static function fromArray(array $data): ChatPhoto {
        $instance = new self();
        if (isset($data['small_file_id'])) {
            $instance->smallFileId = $data['small_file_id'];
        }
        if (isset($data['small_file_unique_id'])) {
            $instance->smallFileUniqueId = $data['small_file_unique_id'];
        }
        if (isset($data['big_file_id'])) {
            $instance->bigFileId = $data['big_file_id'];
        }
        if (isset($data['big_file_unique_id'])) {
            $instance->bigFileUniqueId = $data['big_file_unique_id'];
        }
        return $instance;
    }

    public function __construct(
        ?string $smallFileId = null,
        ?string $smallFileUniqueId = null,
        ?string $bigFileId = null,
        ?string $bigFileUniqueId = null,
    ) {
        $this->smallFileId = $smallFileId;
        $this->smallFileUniqueId = $smallFileUniqueId;
        $this->bigFileId = $bigFileId;
        $this->bigFileUniqueId = $bigFileUniqueId;
    }

    public function getSmallFileId(): ?string {
        return $this->smallFileId;
    }

    public function setSmallFileId(?string $value): self {
        $this->smallFileId = $value;
        return $this;
    }

    public function getSmallFileUniqueId(): ?string {
        return $this->smallFileUniqueId;
    }

    public function setSmallFileUniqueId(?string $value): self {
        $this->smallFileUniqueId = $value;
        return $this;
    }

    public function getBigFileId(): ?string {
        return $this->bigFileId;
    }

    public function setBigFileId(?string $value): self {
        $this->bigFileId = $value;
        return $this;
    }

    public function getBigFileUniqueId(): ?string {
        return $this->bigFileUniqueId;
    }

    public function setBigFileUniqueId(?string $value): self {
        $this->bigFileUniqueId = $value;
        return $this;
    }

}
