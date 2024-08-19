<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class RefundedPayment {

    use ObjectTrait;

    /**
     * Currency
     *
     * Three-letter ISO 4217 currency code, or “XTR” for payments in Telegram Stars. Currently, always “XTR”
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * Total Amount
     *
     * Total refunded price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45, total_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
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
     * Telegram Payment Charge Id
     *
     * Telegram payment identifier
     * @var string|null
     */
    protected ?string $telegramPaymentChargeId = null;

    /**
     * Provider Payment Charge Id
     *
     * Optional. Provider payment identifier
     * @var string|null
     */
    protected ?string $providerPaymentChargeId = null;

    public static function fromArray(array $data): RefundedPayment {
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
        if (isset($data['telegram_payment_charge_id'])) {
            $instance->telegramPaymentChargeId = $data['telegram_payment_charge_id'];
        }
        if (isset($data['provider_payment_charge_id'])) {
            $instance->providerPaymentChargeId = $data['provider_payment_charge_id'];
        }
        return $instance;
    }

    public function __construct(
        ?string $currency = null,
        ?int    $totalAmount = null,
        ?string $invoicePayload = null,
        ?string $telegramPaymentChargeId = null,
        ?string $providerPaymentChargeId = null,
    ) {
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->invoicePayload = $invoicePayload;
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
