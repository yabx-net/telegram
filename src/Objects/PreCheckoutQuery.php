<?php

namespace Yabx\Telegram\Objects;

class PreCheckoutQuery {

    /**
     * Id
     *
     * Unique query identifier
     * @var string
     */
    protected string $id;

    /**
     * From
     *
     * User who sent the query
     * @var User
     */
    protected User $from;

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

    /**
     * Invoice Payload
     *
     * Bot specified invoice payload
     * @var string
     */
    protected string $invoicePayload;

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


    public function __construct(array $data) {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['currency'])) {
            $this->currency = $data['currency'];
        }
        if (isset($data['total_amount'])) {
            $this->totalAmount = $data['total_amount'];
        }
        if (isset($data['invoice_payload'])) {
            $this->invoicePayload = $data['invoice_payload'];
        }
        if (isset($data['shipping_option_id'])) {
            $this->shippingOptionId = $data['shipping_option_id'];
        }
        if (isset($data['order_info'])) {
            $this->orderInfo = new OrderInfo($data['order_info']);
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getFrom(): User {
        return $this->from;
    }

    public function getCurrency(): string {
        return $this->currency;
    }

    public function getTotalAmount(): int {
        return $this->totalAmount;
    }

    public function getInvoicePayload(): string {
        return $this->invoicePayload;
    }

    public function getShippingOptionId(): ?string {
        return $this->shippingOptionId;
    }

    public function getOrderInfo(): ?OrderInfo {
        return $this->orderInfo;
    }


}
