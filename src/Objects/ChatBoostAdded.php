<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatBoostAdded {

    use ObjectTrait;

    /**
     * Boost Count
     *
     * Number of boosts added by the user
     * @var int|null
     */
    protected ?int $boostCount = null;

    public static function fromArray(array $data): ChatBoostAdded {
        $instance = new self();
        if (isset($data['boost_count'])) {
            $instance->boostCount = $data['boost_count'];
        }
        return $instance;
    }

    public function __construct(
        ?int $boostCount = null,
    ) {
        $this->boostCount = $boostCount;
    }

    public function getBoostCount(): ?int {
        return $this->boostCount;
    }

    public function setBoostCount(?int $value): self {
        $this->boostCount = $value;
        return $this;
    }

}
