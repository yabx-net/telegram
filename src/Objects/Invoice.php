<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Invoice {

    use ObjectTrait;

    /**
     * Title
     *
     * Product name
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Description
     *
     * Product description
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Start Parameter
     *
     * Unique bot deep-linking parameter that can be used to generate this invoice
     * @var string|null
     */
    protected ?string $startParameter = null;

    /**
     * Currency
     *
     * Three-letter ISO 4217 currency code
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * Total Amount
     *
     * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @var int|null
     */
    protected ?int $totalAmount = null;

    public function __construct(
        ?string $title = null,
        ?string $description = null,
        ?string $startParameter = null,
        ?string $currency = null,
        ?int    $totalAmount = null,
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->startParameter = $startParameter;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
    }

    public static function fromArray(array $data): Invoice {
        $instance = new self();
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['start_parameter'])) {
            $instance->startParameter = $data['start_parameter'];
        }
        if (isset($data['currency'])) {
            $instance->currency = $data['currency'];
        }
        if (isset($data['total_amount'])) {
            $instance->totalAmount = $data['total_amount'];
        }
        return $instance;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
        return $this;
    }

    public function getStartParameter(): ?string {
        return $this->startParameter;
    }

    public function setStartParameter(?string $value): self {
        $this->startParameter = $value;
        return $this;
    }

    public function getCurrency(): ?string {
        return $this->currency;
    }

    public function setCurrency(?string $value): self {
        $this->currency = $value;
        return $this;
    }

    public function getTotalAmount(): ?int {
        return $this->totalAmount;
    }

    public function setTotalAmount(?int $value): self {
        $this->totalAmount = $value;
        return $this;
    }

}
