<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class OrderInfo {

    use ObjectTrait;

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

    public static function fromArray(array $data): OrderInfo {
        $instance = new self();
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['phone_number'])) {
            $instance->phoneNumber = $data['phone_number'];
        }
        if (isset($data['email'])) {
            $instance->email = $data['email'];
        }
        if (isset($data['shipping_address'])) {
            $instance->shippingAddress = ShippingAddress::fromArray($data['shipping_address']);
        }
        return $instance;
    }

    public function __construct(
        ?string          $name = null,
        ?string          $phoneNumber = null,
        ?string          $email = null,
        ?ShippingAddress $shippingAddress = null,
    ) {
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->shippingAddress = $shippingAddress;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $value): self {
        $this->phoneNumber = $value;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $value): self {
        $this->email = $value;
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
