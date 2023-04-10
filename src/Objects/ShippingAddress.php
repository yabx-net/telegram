<?php

namespace Yabx\Telegram\Objects;

class ShippingAddress {

    /**
     * Country Code
     *
     * Two-letter ISO 3166-1 alpha-2 country code
     * @var string
     */
    protected string $countryCode;

    /**
     * State
     *
     * State, if applicable
     * @var string
     */
    protected string $state;

    /**
     * City
     *
     * City
     * @var string
     */
    protected string $city;

    /**
     * Street Line1
     *
     * First line for the address
     * @var string
     */
    protected string $streetLine1;

    /**
     * Street Line2
     *
     * Second line for the address
     * @var string
     */
    protected string $streetLine2;

    /**
     * Post Code
     *
     * Address post code
     * @var string
     */
    protected string $postCode;


    public function __construct(array $data) {
        if (isset($data['country_code'])) {
            $this->countryCode = $data['country_code'];
        }
        if (isset($data['state'])) {
            $this->state = $data['state'];
        }
        if (isset($data['city'])) {
            $this->city = $data['city'];
        }
        if (isset($data['street_line1'])) {
            $this->streetLine1 = $data['street_line1'];
        }
        if (isset($data['street_line2'])) {
            $this->streetLine2 = $data['street_line2'];
        }
        if (isset($data['post_code'])) {
            $this->postCode = $data['post_code'];
        }
    }

    public function getCountryCode(): string {
        return $this->countryCode;
    }

    public function getState(): string {
        return $this->state;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getStreetLine1(): string {
        return $this->streetLine1;
    }

    public function getStreetLine2(): string {
        return $this->streetLine2;
    }

    public function getPostCode(): string {
        return $this->postCode;
    }


}
