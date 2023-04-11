<?php

namespace Yabx\Telegram\Objects;

class OrderInfo {

    /**
     * Name
     *
     * Optional. User name
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Phone Number
     *
     * Optional. User's phone number
     * @var string|null
     */
    protected ?string $phoneNumber = null;

    /**
     * Email
     *
     * Optional. User email
     * @var string|null
     */
    protected ?string $email = null;

    /**
     * Shipping Address
     *
     * Optional. User shipping address
     * @var ShippingAddress|null
     */
    protected ?ShippingAddress $shippingAddress = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['phone_number'])) {
            $this->phoneNumber = $data['phone_number'];
        }
        if (isset($data['email'])) {
            $this->email = $data['email'];
        }
        if (isset($data['shipping_address'])) {
            $this->shippingAddress = new ShippingAddress($data['shipping_address']);
        }
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getShippingAddress(): ?ShippingAddress {
        return $this->shippingAddress;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
