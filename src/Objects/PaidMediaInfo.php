<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PaidMediaInfo {

    use ObjectTrait;

    /**
     * Star Count
     *
     * The number of Telegram Stars that must be paid to buy access to the media
     * @var int|null
     */
    protected ?int $starCount = null;

    /**
     * Paid Media
     *
     * Information about the paid media
     * @var PaidMedia[]|null
     */
    protected ?array $paidMedia = null;

    public function __construct(
        ?int   $starCount = null,
        ?array $paidMedia = null,
    ) {
        $this->starCount = $starCount;
        $this->paidMedia = $paidMedia;
    }

    public static function fromArray(array $data): PaidMediaInfo {
        $instance = new self();
        if (isset($data['star_count'])) {
            $instance->starCount = $data['star_count'];
        }
        if (isset($data['paid_media'])) {
            $instance->paidMedia = [];
            foreach ($data['paid_media'] as $item) {
                $instance->paidMedia[] = PaidMedia::fromArray($item);
            }
        }
        return $instance;
    }

    public function getStarCount(): ?int {
        return $this->starCount;
    }

    public function setStarCount(?int $value): self {
        $this->starCount = $value;
        return $this;
    }

    public function getPaidMedia(): ?array {
        return $this->paidMedia;
    }

    public function setPaidMedia(?array $value): self {
        $this->paidMedia = $value;
        return $this;
    }

}
