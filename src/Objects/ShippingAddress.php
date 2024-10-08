<?php

namespace Yabx\Telegram\Objects;

final class ShippingAddress extends AbstractObject {

    /**
     * Country Code
     *
     * Two-letter ISO 3166-1 alpha-2 country code
     * @var string|null
     */
    protected ?string $countryCode = null;

    /**
     * State
     *
     * State, if applicable
     * @var string|null
     */
    protected ?string $state = null;

    /**
     * City
     *
     * City
     * @var string|null
     */
    protected ?string $city = null;

    /**
     * Street Line1
     *
     * First line for the address
     * @var string|null
     */
    protected ?string $streetLine1 = null;

    /**
     * Street Line2
     *
     * Second line for the address
     * @var string|null
     */
    protected ?string $streetLine2 = null;

    /**
     * Post Code
     *
     * Address post code
     * @var string|null
     */
    protected ?string $postCode = null;

    public function __construct(
        ?string $countryCode = null,
        ?string $state = null,
        ?string $city = null,
        ?string $streetLine1 = null,
        ?string $streetLine2 = null,
        ?string $postCode = null,
    ) {
        $this->countryCode = $countryCode;
        $this->state = $state;
        $this->city = $city;
        $this->streetLine1 = $streetLine1;
        $this->streetLine2 = $streetLine2;
        $this->postCode = $postCode;
    }

    public static function fromArray(array $data): ShippingAddress {
        $instance = new self();
        if (isset($data['country_code'])) {
            $instance->countryCode = $data['country_code'];
        }
        if (isset($data['state'])) {
            $instance->state = $data['state'];
        }
        if (isset($data['city'])) {
            $instance->city = $data['city'];
        }
        if (isset($data['street_line1'])) {
            $instance->streetLine1 = $data['street_line1'];
        }
        if (isset($data['street_line2'])) {
            $instance->streetLine2 = $data['street_line2'];
        }
        if (isset($data['post_code'])) {
            $instance->postCode = $data['post_code'];
        }
        return $instance;
    }

    public function getCountryCode(): ?string {
        return $this->countryCode;
    }

    public function setCountryCode(?string $value): self {
        $this->countryCode = $value;
        return $this;
    }

    public function getState(): ?string {
        return $this->state;
    }

    public function setState(?string $value): self {
        $this->state = $value;
        return $this;
    }

    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity(?string $value): self {
        $this->city = $value;
        return $this;
    }

    public function getStreetLine1(): ?string {
        return $this->streetLine1;
    }

    public function setStreetLine1(?string $value): self {
        $this->streetLine1 = $value;
        return $this;
    }

    public function getStreetLine2(): ?string {
        return $this->streetLine2;
    }

    public function setStreetLine2(?string $value): self {
        $this->streetLine2 = $value;
        return $this;
    }

    public function getPostCode(): ?string {
        return $this->postCode;
    }

    public function setPostCode(?string $value): self {
        $this->postCode = $value;
        return $this;
    }

}
