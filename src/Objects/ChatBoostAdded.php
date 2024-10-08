<?php

namespace Yabx\Telegram\Objects;

final class ChatBoostAdded extends AbstractObject {

    /**
     * Boost Count
     *
     * Number of boosts added by the user
     * @var int|null
     */
    protected ?int $boostCount = null;

    public function __construct(
        ?int $boostCount = null,
    ) {
        $this->boostCount = $boostCount;
    }

    public static function fromArray(array $data): ChatBoostAdded {
        $instance = new self();
        if (isset($data['boost_count'])) {
            $instance->boostCount = $data['boost_count'];
        }
        return $instance;
    }

    public function getBoostCount(): ?int {
        return $this->boostCount;
    }

    public function setBoostCount(?int $value): self {
        $this->boostCount = $value;
        return $this;
    }

}
