<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class UserProfilePhotos {

    use ObjectTrait;

    /**
     * Total Count
     *
     * Total number of profile pictures the target user has
     * @var int|null
     */
    protected ?int $totalCount = null;

    /**
     * Photos
     *
     * Requested profile pictures (in up to 4 sizes each)
     * @var PhotoSize[]|null
     */
    protected ?array $photos = null;

    public function __construct(
        ?int   $totalCount = null,
        ?array $photos = null,
    ) {
        $this->totalCount = $totalCount;
        $this->photos = $photos;
    }

    public static function fromArray(array $data): UserProfilePhotos {
        $instance = new self();
        if (isset($data['total_count'])) {
            $instance->totalCount = $data['total_count'];
        }
        if (isset($data['photos'])) {
            $instance->photos = [];
            foreach ($data['photos'] as $item) {
                $instance->photos[] = PhotoSize::fromArray($item);
            }
        }
        return $instance;
    }

    public function getTotalCount(): ?int {
        return $this->totalCount;
    }

    public function setTotalCount(?int $value): self {
        $this->totalCount = $value;
        return $this;
    }

    public function getPhotos(): ?array {
        return $this->photos;
    }

    public function setPhotos(?array $value): self {
        $this->photos = $value;
        return $this;
    }

}
