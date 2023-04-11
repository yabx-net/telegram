<?php

namespace Yabx\Telegram\Objects;

class UserProfilePhotos {

    /**
     * Total Count
     *
     * Total number of profile pictures the target user has
     * @var int
     */
    protected int $totalCount;

    /**
     * Photos
     *
     * Requested profile pictures (in up to 4 sizes each)
     * @var PhotoSize[]
     */
    protected array $photos;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['total_count'])) {
            $this->totalCount = $data['total_count'];
        }
        if (isset($data['photos'])) {
            $this->photos = [];
            foreach ($data['photos'] as $item) {
                $this->photos[] = new PhotoSize($item);
            }
        }
    }

    public function getTotalCount(): int {
        return $this->totalCount;
    }

    public function getPhotos(): array {
        return $this->photos;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
