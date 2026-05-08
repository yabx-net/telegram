<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the types of gifts that can be gifted to a user or a chat.
 * @link https://core.telegram.org/bots/api#acceptedgifttypes
 */
final class AcceptedGiftTypes extends AbstractObject {

    /**
     * Unlimited Gifts
     *
     * True, if unlimited regular gifts are accepted
     * @var bool|null
     */
    protected ?bool $unlimitedGifts = null;

    /**
     * Limited Gifts
     *
     * True, if limited regular gifts are accepted
     * @var bool|null
     */
    protected ?bool $limitedGifts = null;

    /**
     * Unique Gifts
     *
     * True, if unique gifts or gifts that can be upgraded to unique for free are accepted
     * @var bool|null
     */
    protected ?bool $uniqueGifts = null;

    /**
     * Premium Subscription
     *
     * True, if a Telegram Premium subscription is accepted
     * @var bool|null
     */
    protected ?bool $premiumSubscription = null;

    /**
     * Gifts From Channels
     *
     * True, if transfers of unique gifts from channels are accepted
     * @var bool|null
     */
    protected ?bool $giftsFromChannels = null;

    public static function fromArray(array $data): AcceptedGiftTypes {
        $instance = new self();
        if (isset($data['unlimited_gifts'])) {
            $instance->unlimitedGifts = $data['unlimited_gifts'];
        }
        if (isset($data['limited_gifts'])) {
            $instance->limitedGifts = $data['limited_gifts'];
        }
        if (isset($data['unique_gifts'])) {
            $instance->uniqueGifts = $data['unique_gifts'];
        }
        if (isset($data['premium_subscription'])) {
            $instance->premiumSubscription = $data['premium_subscription'];
        }
        if (isset($data['gifts_from_channels'])) {
            $instance->giftsFromChannels = $data['gifts_from_channels'];
        }
        return $instance;
    }

    public function __construct(
        ?bool $unlimitedGifts = null,
        ?bool $limitedGifts = null,
        ?bool $uniqueGifts = null,
        ?bool $premiumSubscription = null,
        ?bool $giftsFromChannels = null,
    ) {
        $this->unlimitedGifts = $unlimitedGifts;
        $this->limitedGifts = $limitedGifts;
        $this->uniqueGifts = $uniqueGifts;
        $this->premiumSubscription = $premiumSubscription;
        $this->giftsFromChannels = $giftsFromChannels;
    }

    public function getUnlimitedGifts(): ?bool {
        return $this->unlimitedGifts;
    }

    public function setUnlimitedGifts(?bool $value): self {
        $this->unlimitedGifts = $value;
        return $this;
    }

    public function getLimitedGifts(): ?bool {
        return $this->limitedGifts;
    }

    public function setLimitedGifts(?bool $value): self {
        $this->limitedGifts = $value;
        return $this;
    }

    public function getUniqueGifts(): ?bool {
        return $this->uniqueGifts;
    }

    public function setUniqueGifts(?bool $value): self {
        $this->uniqueGifts = $value;
        return $this;
    }

    public function getPremiumSubscription(): ?bool {
        return $this->premiumSubscription;
    }

    public function setPremiumSubscription(?bool $value): self {
        $this->premiumSubscription = $value;
        return $this;
    }

    public function getGiftsFromChannels(): ?bool {
        return $this->giftsFromChannels;
    }

    public function setGiftsFromChannels(?bool $value): self {
        $this->giftsFromChannels = $value;
        return $this;
    }

}
