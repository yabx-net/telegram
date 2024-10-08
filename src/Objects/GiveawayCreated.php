<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GiveawayCreated {

    use ObjectTrait;

    /**
     * Prize Star Count
     *
     * Optional. The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only
     * @var int|null
     */
    protected ?int $prizeStarCount = null;

    public function __construct(
        ?int $prizeStarCount = null,
    ) {
        $this->prizeStarCount = $prizeStarCount;
    }

    public static function fromArray(array $data): GiveawayCreated {
        $instance = new self();
        if (isset($data['prize_star_count'])) {
            $instance->prizeStarCount = $data['prize_star_count'];
        }
        return $instance;
    }

    public function getPrizeStarCount(): ?int {
        return $this->prizeStarCount;
    }

    public function setPrizeStarCount(?int $value): self {
        $this->prizeStarCount = $value;
        return $this;
    }

}
