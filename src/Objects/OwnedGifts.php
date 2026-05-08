<?php

namespace Yabx\Telegram\Objects;

/**
 * Contains the list of gifts received and owned by a user or a chat.
 * @link https://core.telegram.org/bots/api#ownedgifts
 */
final class OwnedGifts extends AbstractObject {

    /**
     * Total Count
     *
     * The total number of gifts owned by the user or the chat
     * @var int|null
     */
    protected ?int $totalCount = null;

    /**
     * Gifts
     *
     * The list of gifts
     * @var OwnedGift[]|null
     */
    protected ?array $gifts = null;

    /**
     * Next Offset
     *
     * Optional. Offset for the next request. If empty, then there are no more results
     * @var string|null
     */
    protected ?string $nextOffset = null;

    public static function fromArray(array $data): OwnedGifts {
        $instance = new self();
        if (isset($data['total_count'])) {
            $instance->totalCount = $data['total_count'];
        }
        if (isset($data['gifts'])) {
            $instance->gifts = [];
            foreach ($data['gifts'] as $item) {
                $instance->gifts[] = OwnedGift::fromArray($item);
            }
        }
        if (isset($data['next_offset'])) {
            $instance->nextOffset = $data['next_offset'];
        }
        return $instance;
    }

    public function __construct(
        ?int $totalCount = null,
        ?array $gifts = null,
        ?string $nextOffset = null,
    ) {
        $this->totalCount = $totalCount;
        $this->gifts = $gifts;
        $this->nextOffset = $nextOffset;
    }

    public function getTotalCount(): ?int {
        return $this->totalCount;
    }

    public function setTotalCount(?int $value): self {
        $this->totalCount = $value;
        return $this;
    }

    public function getGifts(): ?array {
        return $this->gifts;
    }

    public function setGifts(?array $value): self {
        $this->gifts = $value;
        return $this;
    }

    public function getNextOffset(): ?string {
        return $this->nextOffset;
    }

    public function setNextOffset(?string $value): self {
        $this->nextOffset = $value;
        return $this;
    }

}
