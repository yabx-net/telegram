<?php

namespace Yabx\Telegram\Objects;

class ShippingQuery {

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
     * Invoice Payload
     *
     * Bot specified invoice payload
     * @var string
     */
    protected string $invoicePayload;

    /**
     * Shipping Address
     *
     * User specified shipping address
     * @var ShippingAddress
     */
    protected ShippingAddress $shippingAddress;


    public function __construct(array $data) {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['invoice_payload'])) {
            $this->invoicePayload = $data['invoice_payload'];
        }
        if (isset($data['shipping_address'])) {
            $this->shippingAddress = new ShippingAddress($data['shipping_address']);
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getFrom(): User {
        return $this->from;
    }

    public function getInvoicePayload(): string {
        return $this->invoicePayload;
    }

    public function getShippingAddress(): ShippingAddress {
        return $this->shippingAddress;
    }


}
