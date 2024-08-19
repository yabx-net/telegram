<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ShippingQuery {

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
     * Invoice Payload
     *
     * Bot-specified invoice payload
     * @var string|null
     */
    protected ?string $invoicePayload = null;

    /**
     * Shipping Address
     *
     * User specified shipping address
     * @var ShippingAddress|null
     */
    protected ?ShippingAddress $shippingAddress = null;

    public static function fromArray(array $data): ShippingQuery {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['invoice_payload'])) {
            $instance->invoicePayload = $data['invoice_payload'];
        }
        if (isset($data['shipping_address'])) {
            $instance->shippingAddress = ShippingAddress::fromArray($data['shipping_address']);
        }
        return $instance;
    }

    public function __construct(
        ?string          $id = null,
        ?User            $from = null,
        ?string          $invoicePayload = null,
        ?ShippingAddress $shippingAddress = null,
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->invoicePayload = $invoicePayload;
        $this->shippingAddress = $shippingAddress;
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

    public function getInvoicePayload(): ?string {
        return $this->invoicePayload;
    }

    public function setInvoicePayload(?string $value): self {
        $this->invoicePayload = $value;
        return $this;
    }

    public function getShippingAddress(): ?ShippingAddress {
        return $this->shippingAddress;
    }

    public function setShippingAddress(?ShippingAddress $value): self {
        $this->shippingAddress = $value;
        return $this;
    }

}
