<?php

namespace Yabx\Telegram\Objects;

class LabeledPrice {

    /**
     * Label
     *
     * Portion label
     * @var string
     */
    protected string $label;

    /**
     * Amount
     *
     * Price of the product in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @var int
     */
    protected int $amount;


    public function __construct(array $data) {
        if (isset($data['label'])) {
            $this->label = $data['label'];
        }
        if (isset($data['amount'])) {
            $this->amount = $data['amount'];
        }
    }

    public function getLabel(): string {
        return $this->label;
    }

    public function getAmount(): int {
        return $this->amount;
    }


}
