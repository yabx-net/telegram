<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PreCheckoutQuery {

    use ObjectTrait;

    /**
     * Id
     *
     * Unique query identifier
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * From
     *
     * User who sent the query
     * @var User|null
     */
    protected ?User $from = null;

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

    /**
     * Invoice Payload
     *
     * Bot specified invoice payload
     * @var string|null
     */
    protected ?string $invoicePayload = null;

    /**
     * Shipping Option Id
     *
     * Optional. Identifier of the shipping option chosen by the user
     * @var string|null
     */
    protected ?string $shippingOptionId = null;

    /**
     * Order Info
     *
     * Optional. Order information provided by the user
     * @var OrderInfo|null
     */
    protected ?OrderInfo $orderInfo = null;

    public function __construct(
        ?string    $id = null,
        ?User      $from = null,
        ?string    $currency = null,
        ?int       $totalAmount = null,
        ?string    $invoicePayload = null,
        ?string    $shippingOptionId = null,
        ?OrderInfo $orderInfo = null,
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->invoicePayload = $invoicePayload;
        $this->shippingOptionId = $shippingOptionId;
        $this->orderInfo = $orderInfo;
    }

    public static function fromArray(array $data): PreCheckoutQuery {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['currency'])) {
            $instance->currency = $data['currency'];
        }
        if (isset($data['total_amount'])) {
            $instance->totalAmount = $data['total_amount'];
        }
        if (isset($data['invoice_payload'])) {
            $instance->invoicePayload = $data['invoice_payload'];
        }
        if (isset($data['shipping_option_id'])) {
            $instance->shippingOptionId = $data['shipping_option_id'];
        }
        if (isset($data['order_info'])) {
            $instance->orderInfo = OrderInfo::fromArray($data['order_info']);
        }
        return $instance;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
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

    public function getInvoicePayload(): ?string {
        return $this->invoicePayload;
    }

    public function setInvoicePayload(?string $value): self {
        $this->invoicePayload = $value;
        return $this;
    }

    public function getShippingOptionId(): ?string {
        return $this->shippingOptionId;
    }

    public function setShippingOptionId(?string $value): self {
        $this->shippingOptionId = $value;
        return $this;
    }

    public function getOrderInfo(): ?OrderInfo {
        return $this->orderInfo;
    }

    public function setOrderInfo(?OrderInfo $value): self {
        $this->orderInfo = $value;
        return $this;
    }

}
