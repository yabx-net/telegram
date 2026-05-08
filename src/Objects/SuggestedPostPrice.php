<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes the price of a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostprice
 */
final class SuggestedPostPrice extends AbstractObject {

    /**
     * Currency
     *
     * Currency in which the post will be paid. Currently, must be one of “XTR” for Telegram Stars or “TON” for toncoins
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * Amount
     *
     * The amount of the currency that will be paid for the post in the smallest units of the currency, i.e. Telegram Stars or nanotoncoins. Currently, price in Telegram Stars must be between 5 and 100000, and price in nanotoncoins must be between 10000000 and 10000000000000.
     * @var int|null
     */
    protected ?int $amount = null;

    public static function fromArray(array $data): SuggestedPostPrice {
        $instance = new self();
        if (isset($data['currency'])) {
            $instance->currency = $data['currency'];
        }
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        return $instance;
    }

    public function __construct(
        ?string $currency = null,
        ?int $amount = null,
    ) {
        $this->currency = $currency;
        $this->amount = $amount;
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

}
