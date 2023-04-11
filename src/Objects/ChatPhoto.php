<?php

namespace Yabx\Telegram\Objects;

class ChatPhoto {

    /**
     * Small File Id
     *
     * File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     * @var string
     */
    protected string $smallFileId;

    /**
     * Small File Unique Id
     *
     * Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string
     */
    protected string $smallFileUniqueId;

    /**
     * Big File Id
     *
     * File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     * @var string
     */
    protected string $bigFileId;

    /**
     * Big File Unique Id
     *
     * Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string
     */
    protected string $bigFileUniqueId;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['small_file_id'])) {
            $this->smallFileId = $data['small_file_id'];
        }
        if (isset($data['small_file_unique_id'])) {
            $this->smallFileUniqueId = $data['small_file_unique_id'];
        }
        if (isset($data['big_file_id'])) {
            $this->bigFileId = $data['big_file_id'];
        }
        if (isset($data['big_file_unique_id'])) {
            $this->bigFileUniqueId = $data['big_file_unique_id'];
        }
    }

    public function getSmallFileId(): string {
        return $this->smallFileId;
    }

    public function getSmallFileUniqueId(): string {
        return $this->smallFileUniqueId;
    }

    public function getBigFileId(): string {
        return $this->bigFileId;
    }

    public function getBigFileUniqueId(): string {
        return $this->bigFileUniqueId;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
