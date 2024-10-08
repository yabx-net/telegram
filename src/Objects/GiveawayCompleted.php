<?php

namespace Yabx\Telegram\Objects;

final class GiveawayCompleted extends AbstractObject {

    /**
     * Winner Count
     *
     * Number of winners in the giveaway
     * @var int|null
     */
    protected ?int $winnerCount = null;

    /**
     * Unclaimed Prize Count
     *
     * Optional. Number of undistributed prizes
     * @var int|null
     */
    protected ?int $unclaimedPrizeCount = null;

    /**
     * Giveaway Message
     *
     * Optional. Message with the giveaway that was completed, if it wasn't deleted
     * @var Message|null
     */
    protected ?Message $giveawayMessage = null;

    /**
     * Is Star Giveaway
     *
     * Optional. True, if the giveaway is a Telegram Star giveaway. Otherwise, currently, the giveaway is a Telegram Premium giveaway.
     * @var bool|null
     */
    protected ?bool $isStarGiveaway = null;

    public function __construct(
        ?int     $winnerCount = null,
        ?int     $unclaimedPrizeCount = null,
        ?Message $giveawayMessage = null,
        ?bool    $isStarGiveaway = null,
    ) {
        $this->winnerCount = $winnerCount;
        $this->unclaimedPrizeCount = $unclaimedPrizeCount;
        $this->giveawayMessage = $giveawayMessage;
        $this->isStarGiveaway = $isStarGiveaway;
    }

    public static function fromArray(array $data): GiveawayCompleted {
        $instance = new self();
        if (isset($data['winner_count'])) {
            $instance->winnerCount = $data['winner_count'];
        }
        if (isset($data['unclaimed_prize_count'])) {
            $instance->unclaimedPrizeCount = $data['unclaimed_prize_count'];
        }
        if (isset($data['giveaway_message'])) {
            $instance->giveawayMessage = Message::fromArray($data['giveaway_message']);
        }
        if (isset($data['is_star_giveaway'])) {
            $instance->isStarGiveaway = $data['is_star_giveaway'];
        }
        return $instance;
    }

    public function getWinnerCount(): ?int {
        return $this->winnerCount;
    }

    public function setWinnerCount(?int $value): self {
        $this->winnerCount = $value;
        return $this;
    }

    public function getUnclaimedPrizeCount(): ?int {
        return $this->unclaimedPrizeCount;
    }

    public function setUnclaimedPrizeCount(?int $value): self {
        $this->unclaimedPrizeCount = $value;
        return $this;
    }

    public function getGiveawayMessage(): ?Message {
        return $this->giveawayMessage;
    }

    public function setGiveawayMessage(?Message $value): self {
        $this->giveawayMessage = $value;
        return $this;
    }

    public function getIsStarGiveaway(): ?bool {
        return $this->isStarGiveaway;
    }

    public function setIsStarGiveaway(?bool $value): self {
        $this->isStarGiveaway = $value;
        return $this;
    }

}
