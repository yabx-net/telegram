<?php

namespace Yabx\Telegram\Objects;

final class SuccessfulPayment extends AbstractObject {

    /**
     * Currency
     *
     * Three-letter ISO 4217 currency code, or “XTR” for payments in Telegram Stars
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
     * Bot-specified invoice payload
     * @var string|null
     */
    protected ?string $invoicePayload = null;

    /**
     * Subscription Expiration Date
     *
     * Optional. Expiration date of the subscription, in Unix time; for recurring payments only
     * @var int|null
     */
    protected ?int $subscriptionExpirationDate = null;

    /**
     * Is Recurring
     *
     * Optional. True, if the payment is a recurring payment for a subscription
     * @var bool|null
     */
    protected ?bool $isRecurring = null;

    /**
     * Is First Recurring
     *
     * Optional. True, if the payment is the first payment for a subscription
     * @var bool|null
     */
    protected ?bool $isFirstRecurring = null;

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

    /**
     * Telegram Payment Charge Id
     *
     * Telegram payment identifier
     * @var string|null
     */
    protected ?string $telegramPaymentChargeId = null;

    /**
     * Provider Payment Charge Id
     *
     * Provider payment identifier
     * @var string|null
     */
    protected ?string $providerPaymentChargeId = null;

    public static function fromArray(array $data): SuccessfulPayment {
        $instance = new self();
        if (isset($data['currency'])) {
            $instance->currency = $data['currency'];
        }
        if (isset($data['total_amount'])) {
            $instance->totalAmount = $data['total_amount'];
        }
        if (isset($data['invoice_payload'])) {
            $instance->invoicePayload = $data['invoice_payload'];
        }
        if (isset($data['subscription_expiration_date'])) {
            $instance->subscriptionExpirationDate = $data['subscription_expiration_date'];
        }
        if (isset($data['is_recurring'])) {
            $instance->isRecurring = $data['is_recurring'];
        }
        if (isset($data['is_first_recurring'])) {
            $instance->isFirstRecurring = $data['is_first_recurring'];
        }
        if (isset($data['shipping_option_id'])) {
            $instance->shippingOptionId = $data['shipping_option_id'];
        }
        if (isset($data['order_info'])) {
            $instance->orderInfo = OrderInfo::fromArray($data['order_info']);
        }
        if (isset($data['telegram_payment_charge_id'])) {
            $instance->telegramPaymentChargeId = $data['telegram_payment_charge_id'];
        }
        if (isset($data['provider_payment_charge_id'])) {
            $instance->providerPaymentChargeId = $data['provider_payment_charge_id'];
        }
        return $instance;
    }

    public function __construct(
        ?string    $currency = null,
        ?int       $totalAmount = null,
        ?string    $invoicePayload = null,
        ?int       $subscriptionExpirationDate = null,
        ?bool      $isRecurring = null,
        ?bool      $isFirstRecurring = null,
        ?string    $shippingOptionId = null,
        ?OrderInfo $orderInfo = null,
        ?string    $telegramPaymentChargeId = null,
        ?string    $providerPaymentChargeId = null,
    ) {
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->invoicePayload = $invoicePayload;
        $this->subscriptionExpirationDate = $subscriptionExpirationDate;
        $this->isRecurring = $isRecurring;
        $this->isFirstRecurring = $isFirstRecurring;
        $this->shippingOptionId = $shippingOptionId;
        $this->orderInfo = $orderInfo;
        $this->telegramPaymentChargeId = $telegramPaymentChargeId;
        $this->providerPaymentChargeId = $providerPaymentChargeId;
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

    public function getSubscriptionExpirationDate(): ?int {
        return $this->subscriptionExpirationDate;
    }

    public function setSubscriptionExpirationDate(?int $value): self {
        $this->subscriptionExpirationDate = $value;
        return $this;
    }

    public function getIsRecurring(): ?bool {
        return $this->isRecurring;
    }

    public function setIsRecurring(?bool $value): self {
        $this->isRecurring = $value;
        return $this;
    }

    public function getIsFirstRecurring(): ?bool {
        return $this->isFirstRecurring;
    }

    public function setIsFirstRecurring(?bool $value): self {
        $this->isFirstRecurring = $value;
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

    public function getTelegramPaymentChargeId(): ?string {
        return $this->telegramPaymentChargeId;
    }

    public function setTelegramPaymentChargeId(?string $value): self {
        $this->telegramPaymentChargeId = $value;
        return $this;
    }

    public function getProviderPaymentChargeId(): ?string {
        return $this->providerPaymentChargeId;
    }

    public function setProviderPaymentChargeId(?string $value): self {
        $this->providerPaymentChargeId = $value;
        return $this;
    }

}
