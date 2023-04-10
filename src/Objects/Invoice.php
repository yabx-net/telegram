<?php

namespace Yabx\Telegram\Objects;

class Invoice {

    /**
     * Title
     *
     * Product name
     * @var string
     */
    protected string $title;

    /**
     * Description
     *
     * Product description
     * @var string
     */
    protected string $description;

    /**
     * Start Parameter
     *
     * Unique bot deep-linking parameter that can be used to generate this invoice
     * @var string
     */
    protected string $startParameter;

    /**
     * Currency
     *
     * Three-letter ISO 4217 currency code
     * @var string
     */
    protected string $currency;

    /**
     * Total Amount
     *
     * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @var int
     */
    protected int $totalAmount;


    public function __construct(array $data) {
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['start_parameter'])) {
            $this->startParameter = $data['start_parameter'];
        }
        if (isset($data['currency'])) {
            $this->currency = $data['currency'];
        }
        if (isset($data['total_amount'])) {
            $this->totalAmount = $data['total_amount'];
        }
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStartParameter(): string {
        return $this->startParameter;
    }

    public function getCurrency(): string {
        return $this->currency;
    }

    public function getTotalAmount(): int {
        return $this->totalAmount;
    }


}
