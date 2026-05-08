<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes an amount of Telegram Stars.
 * @link https://core.telegram.org/bots/api#staramount
 */
final class StarAmount extends AbstractObject {

    /**
     * Amount
     *
     * Integer amount of Telegram Stars, rounded to 0; can be negative
     * @var int|null
     */
    protected ?int $amount = null;

    /**
     * Nanostar Amount
     *
     * Optional. The number of 1/1000000000 shares of Telegram Stars; from -999999999 to 999999999; can be negative if and only if amount is non-positive
     * @var int|null
     */
    protected ?int $nanostarAmount = null;

    public static function fromArray(array $data): StarAmount {
        $instance = new self();
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        if (isset($data['nanostar_amount'])) {
            $instance->nanostarAmount = $data['nanostar_amount'];
        }
        return $instance;
    }

    public function __construct(
        ?int $amount = null,
        ?int $nanostarAmount = null,
    ) {
        $this->amount = $amount;
        $this->nanostarAmount = $nanostarAmount;
    }

    public function getAmount(): ?int {
        return $this->amount;
    }

    public function setAmount(?int $value): self {
        $this->amount = $value;
        return $this;
    }

    public function getNanostarAmount(): ?int {
        return $this->nanostarAmount;
    }

    public function setNanostarAmount(?int $value): self {
        $this->nanostarAmount = $value;
        return $this;
    }

}
