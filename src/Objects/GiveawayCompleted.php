<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GiveawayCompleted {

    use ObjectTrait;

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
        return $instance;
    }

    public function __construct(
        ?int     $winnerCount = null,
        ?int     $unclaimedPrizeCount = null,
        ?Message $giveawayMessage = null,
    ) {
        $this->winnerCount = $winnerCount;
        $this->unclaimedPrizeCount = $unclaimedPrizeCount;
        $this->giveawayMessage = $giveawayMessage;
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

}
