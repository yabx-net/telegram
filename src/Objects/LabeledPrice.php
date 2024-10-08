<?php

namespace Yabx\Telegram\Objects;

final class LabeledPrice extends AbstractObject {

    /**
     * Label
     *
     * Portion label
     * @var string|null
     */
    protected ?string $label = null;

    /**
     * Amount
     *
     * Price of the product in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @var int|null
     */
    protected ?int $amount = null;

    public function __construct(
        ?string $label = null,
        ?int    $amount = null,
    ) {
        $this->label = $label;
        $this->amount = $amount;
    }

    public static function fromArray(array $data): LabeledPrice {
        $instance = new self();
        if (isset($data['label'])) {
            $instance->label = $data['label'];
        }
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        return $instance;
    }

    public function getLabel(): ?string {
        return $this->label;
    }

    public function setLabel(?string $value): self {
        $this->label = $value;
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
