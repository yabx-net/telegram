<?php

namespace Yabx\Telegram\Objects;

final class GiveawayWinners extends AbstractObject {

    /**
     * Chat
     *
     * The chat that created the giveaway
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Giveaway Message Id
     *
     * Identifier of the message with the giveaway in the chat
     * @var int|null
     */
    protected ?int $giveawayMessageId = null;

    /**
     * Winners Selection Date
     *
     * Point in time (Unix timestamp) when winners of the giveaway were selected
     * @var int|null
     */
    protected ?int $winnersSelectionDate = null;

    /**
     * Winner Count
     *
     * Total number of winners in the giveaway
     * @var int|null
     */
    protected ?int $winnerCount = null;

    /**
     * Winners
     *
     * List of up to 100 winners of the giveaway
     * @var User[]|null
     */
    protected ?array $winners = null;

    /**
     * Additional Chat Count
     *
     * Optional. The number of other chats the user had to join in order to be eligible for the giveaway
     * @var int|null
     */
    protected ?int $additionalChatCount = null;

    /**
     * Prize Star Count
     *
     * Optional. The number of Telegram Stars that were split between giveaway winners; for Telegram Star giveaways only
     * @var int|null
     */
    protected ?int $prizeStarCount = null;

    /**
     * Premium Subscription Month Count
     *
     * Optional. The number of months the Telegram Premium subscription won from the giveaway will be active for; for Telegram Premium giveaways only
     * @var int|null
     */
    protected ?int $premiumSubscriptionMonthCount = null;

    /**
     * Unclaimed Prize Count
     *
     * Optional. Number of undistributed prizes
     * @var int|null
     */
    protected ?int $unclaimedPrizeCount = null;

    /**
     * Only New Members
     *
     * Optional. True, if only users who had joined the chats after the giveaway started were eligible to win
     * @var bool|null
     */
    protected ?bool $onlyNewMembers = null;

    /**
     * Was Refunded
     *
     * Optional. True, if the giveaway was canceled because the payment for it was refunded
     * @var bool|null
     */
    protected ?bool $wasRefunded = null;

    /**
     * Prize Description
     *
     * Optional. Description of additional giveaway prize
     * @var string|null
     */
    protected ?string $prizeDescription = null;

    public function __construct(
        ?Chat   $chat = null,
        ?int    $giveawayMessageId = null,
        ?int    $winnersSelectionDate = null,
        ?int    $winnerCount = null,
        ?array  $winners = null,
        ?int    $additionalChatCount = null,
        ?int    $prizeStarCount = null,
        ?int    $premiumSubscriptionMonthCount = null,
        ?int    $unclaimedPrizeCount = null,
        ?bool   $onlyNewMembers = null,
        ?bool   $wasRefunded = null,
        ?string $prizeDescription = null,
    ) {
        $this->chat = $chat;
        $this->giveawayMessageId = $giveawayMessageId;
        $this->winnersSelectionDate = $winnersSelectionDate;
        $this->winnerCount = $winnerCount;
        $this->winners = $winners;
        $this->additionalChatCount = $additionalChatCount;
        $this->prizeStarCount = $prizeStarCount;
        $this->premiumSubscriptionMonthCount = $premiumSubscriptionMonthCount;
        $this->unclaimedPrizeCount = $unclaimedPrizeCount;
        $this->onlyNewMembers = $onlyNewMembers;
        $this->wasRefunded = $wasRefunded;
        $this->prizeDescription = $prizeDescription;
    }

    public static function fromArray(array $data): GiveawayWinners {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['giveaway_message_id'])) {
            $instance->giveawayMessageId = $data['giveaway_message_id'];
        }
        if (isset($data['winners_selection_date'])) {
            $instance->winnersSelectionDate = $data['winners_selection_date'];
        }
        if (isset($data['winner_count'])) {
            $instance->winnerCount = $data['winner_count'];
        }
        if (isset($data['winners'])) {
            $instance->winners = [];
            foreach ($data['winners'] as $item) {
                $instance->winners[] = User::fromArray($item);
            }
        }
        if (isset($data['additional_chat_count'])) {
            $instance->additionalChatCount = $data['additional_chat_count'];
        }
        if (isset($data['prize_star_count'])) {
            $instance->prizeStarCount = $data['prize_star_count'];
        }
        if (isset($data['premium_subscription_month_count'])) {
            $instance->premiumSubscriptionMonthCount = $data['premium_subscription_month_count'];
        }
        if (isset($data['unclaimed_prize_count'])) {
            $instance->unclaimedPrizeCount = $data['unclaimed_prize_count'];
        }
        if (isset($data['only_new_members'])) {
            $instance->onlyNewMembers = $data['only_new_members'];
        }
        if (isset($data['was_refunded'])) {
            $instance->wasRefunded = $data['was_refunded'];
        }
        if (isset($data['prize_description'])) {
            $instance->prizeDescription = $data['prize_description'];
        }
        return $instance;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getGiveawayMessageId(): ?int {
        return $this->giveawayMessageId;
    }

    public function setGiveawayMessageId(?int $value): self {
        $this->giveawayMessageId = $value;
        return $this;
    }

    public function getWinnersSelectionDate(): ?int {
        return $this->winnersSelectionDate;
    }

    public function setWinnersSelectionDate(?int $value): self {
        $this->winnersSelectionDate = $value;
        return $this;
    }

    public function getWinnerCount(): ?int {
        return $this->winnerCount;
    }

    public function setWinnerCount(?int $value): self {
        $this->winnerCount = $value;
        return $this;
    }

    public function getWinners(): ?array {
        return $this->winners;
    }

    public function setWinners(?array $value): self {
        $this->winners = $value;
        return $this;
    }

    public function getAdditionalChatCount(): ?int {
        return $this->additionalChatCount;
    }

    public function setAdditionalChatCount(?int $value): self {
        $this->additionalChatCount = $value;
        return $this;
    }

    public function getPrizeStarCount(): ?int {
        return $this->prizeStarCount;
    }

    public function setPrizeStarCount(?int $value): self {
        $this->prizeStarCount = $value;
        return $this;
    }

    public function getPremiumSubscriptionMonthCount(): ?int {
        return $this->premiumSubscriptionMonthCount;
    }

    public function setPremiumSubscriptionMonthCount(?int $value): self {
        $this->premiumSubscriptionMonthCount = $value;
        return $this;
    }

    public function getUnclaimedPrizeCount(): ?int {
        return $this->unclaimedPrizeCount;
    }

    public function setUnclaimedPrizeCount(?int $value): self {
        $this->unclaimedPrizeCount = $value;
        return $this;
    }

    public function getOnlyNewMembers(): ?bool {
        return $this->onlyNewMembers;
    }

    public function setOnlyNewMembers(?bool $value): self {
        $this->onlyNewMembers = $value;
        return $this;
    }

    public function getWasRefunded(): ?bool {
        return $this->wasRefunded;
    }

    public function setWasRefunded(?bool $value): self {
        $this->wasRefunded = $value;
        return $this;
    }

    public function getPrizeDescription(): ?string {
        return $this->prizeDescription;
    }

    public function setPrizeDescription(?string $value): self {
        $this->prizeDescription = $value;
        return $this;
    }

}
