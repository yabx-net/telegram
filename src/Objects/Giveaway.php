<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Giveaway {

    use ObjectTrait;

    /**
     * Chats
     *
     * The list of chats which the user must join to participate in the giveaway
     * @var Chat[]|null
     */
    protected ?array $chats = null;

    /**
     * Winners Selection Date
     *
     * Point in time (Unix timestamp) when winners of the giveaway will be selected
     * @var int|null
     */
    protected ?int $winnersSelectionDate = null;

    /**
     * Winner Count
     *
     * The number of users which are supposed to be selected as winners of the giveaway
     * @var int|null
     */
    protected ?int $winnerCount = null;

    /**
     * Only New Members
     *
     * Optional. True, if only users who join the chats after the giveaway started should be eligible to win
     * @var bool|null
     */
    protected ?bool $onlyNewMembers = null;

    /**
     * Has Public Winners
     *
     * Optional. True, if the list of giveaway winners will be visible to everyone
     * @var bool|null
     */
    protected ?bool $hasPublicWinners = null;

    /**
     * Prize Description
     *
     * Optional. Description of additional giveaway prize
     * @var string|null
     */
    protected ?string $prizeDescription = null;

    /**
     * Country Codes
     *
     * Optional. A list of two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which eligible users for the giveaway must come. If empty, then all users can participate in the giveaway. Users with a phone number that was bought on Fragment can always participate in giveaways.
     * @var string[]|null
     */
    protected ?array $countryCodes = null;

    /**
     * Prize Star Count
     *
     * Optional. The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only
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

    public function __construct(
        ?array  $chats = null,
        ?int    $winnersSelectionDate = null,
        ?int    $winnerCount = null,
        ?bool   $onlyNewMembers = null,
        ?bool   $hasPublicWinners = null,
        ?string $prizeDescription = null,
        ?array  $countryCodes = null,
        ?int    $prizeStarCount = null,
        ?int    $premiumSubscriptionMonthCount = null,
    ) {
        $this->chats = $chats;
        $this->winnersSelectionDate = $winnersSelectionDate;
        $this->winnerCount = $winnerCount;
        $this->onlyNewMembers = $onlyNewMembers;
        $this->hasPublicWinners = $hasPublicWinners;
        $this->prizeDescription = $prizeDescription;
        $this->countryCodes = $countryCodes;
        $this->prizeStarCount = $prizeStarCount;
        $this->premiumSubscriptionMonthCount = $premiumSubscriptionMonthCount;
    }

    public static function fromArray(array $data): Giveaway {
        $instance = new self();
        if (isset($data['chats'])) {
            $instance->chats = [];
            foreach ($data['chats'] as $item) {
                $instance->chats[] = Chat::fromArray($item);
            }
        }
        if (isset($data['winners_selection_date'])) {
            $instance->winnersSelectionDate = $data['winners_selection_date'];
        }
        if (isset($data['winner_count'])) {
            $instance->winnerCount = $data['winner_count'];
        }
        if (isset($data['only_new_members'])) {
            $instance->onlyNewMembers = $data['only_new_members'];
        }
        if (isset($data['has_public_winners'])) {
            $instance->hasPublicWinners = $data['has_public_winners'];
        }
        if (isset($data['prize_description'])) {
            $instance->prizeDescription = $data['prize_description'];
        }
        if (isset($data['country_codes'])) {
            $instance->countryCodes = [];
            foreach ($data['country_codes'] as $item) {
                $instance->countryCodes[] = $item;
            }
        }
        if (isset($data['prize_star_count'])) {
            $instance->prizeStarCount = $data['prize_star_count'];
        }
        if (isset($data['premium_subscription_month_count'])) {
            $instance->premiumSubscriptionMonthCount = $data['premium_subscription_month_count'];
        }
        return $instance;
    }

    public function getChats(): ?array {
        return $this->chats;
    }

    public function setChats(?array $value): self {
        $this->chats = $value;
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

    public function getOnlyNewMembers(): ?bool {
        return $this->onlyNewMembers;
    }

    public function setOnlyNewMembers(?bool $value): self {
        $this->onlyNewMembers = $value;
        return $this;
    }

    public function getHasPublicWinners(): ?bool {
        return $this->hasPublicWinners;
    }

    public function setHasPublicWinners(?bool $value): self {
        $this->hasPublicWinners = $value;
        return $this;
    }

    public function getPrizeDescription(): ?string {
        return $this->prizeDescription;
    }

    public function setPrizeDescription(?string $value): self {
        $this->prizeDescription = $value;
        return $this;
    }

    public function getCountryCodes(): ?array {
        return $this->countryCodes;
    }

    public function setCountryCodes(?array $value): self {
        $this->countryCodes = $value;
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

}
