<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a successful payment for a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostpaid
 */
final class SuggestedPostPaid extends AbstractObject {

    /**
     * Suggested Post Message
     *
     * Optional. Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $suggestedPostMessage = null;

    /**
     * Currency
     *
     * Currency in which the payment was made. Currently, one of “XTR” for Telegram Stars or “TON” for toncoins
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * Amount
     *
     * Optional. The amount of the currency that was received by the channel in nanotoncoins; for payments in toncoins only
     * @var int|null
     */
    protected ?int $amount = null;

    /**
     * Star Amount
     *
     * Optional. The amount of Telegram Stars that was received by the channel; for payments in Telegram Stars only
     * @var StarAmount|null
     */
    protected ?StarAmount $starAmount = null;

    public static function fromArray(array $data): SuggestedPostPaid {
        $instance = new self();
        if (isset($data['suggested_post_message'])) {
            $instance->suggestedPostMessage = Message::fromArray($data['suggested_post_message']);
        }
        if (isset($data['currency'])) {
            $instance->currency = $data['currency'];
        }
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        if (isset($data['star_amount'])) {
            $instance->starAmount = StarAmount::fromArray($data['star_amount']);
        }
        return $instance;
    }

    public function __construct(
        ?Message $suggestedPostMessage = null,
        ?string $currency = null,
        ?int $amount = null,
        ?StarAmount $starAmount = null,
    ) {
        $this->suggestedPostMessage = $suggestedPostMessage;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->starAmount = $starAmount;
    }

    public function getSuggestedPostMessage(): ?Message {
        return $this->suggestedPostMessage;
    }

    public function setSuggestedPostMessage(?Message $value): self {
        $this->suggestedPostMessage = $value;
        return $this;
    }

    public function getCurrency(): ?string {
        return $this->currency;
    }

    public function setCurrency(?string $value): self {
        $this->currency = $value;
        return $this;
    }

    public function getAmount(): ?int {
        return $this->amount;
    }

    public function setAmount(?int $value): self {
        $this->amount = $value;
        return $this;
    }

    public function getStarAmount(): ?StarAmount {
        return $this->starAmount;
    }

    public function setStarAmount(?StarAmount $value): self {
        $this->starAmount = $value;
        return $this;
    }

}
