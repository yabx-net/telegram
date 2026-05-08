<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes the physical address of a location.
 * @link https://core.telegram.org/bots/api#locationaddress
 */
final class LocationAddress extends AbstractObject {

    /**
     * Country Code
     *
     * The two-letter ISO 3166-1 alpha-2 country code of the country where the location is located
     * @var string|null
     */
    protected ?string $countryCode = null;

    /**
     * State
     *
     * Optional. State of the location
     * @var string|null
     */
    protected ?string $state = null;

    /**
     * City
     *
     * Optional. City of the location
     * @var string|null
     */
    protected ?string $city = null;

    /**
     * Street
     *
     * Optional. Street address of the location
     * @var string|null
     */
    protected ?string $street = null;

    public static function fromArray(array $data): LocationAddress {
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
        if (isset($data['street'])) {
            $instance->street = $data['street'];
        }
        return $instance;
    }

    public function __construct(
        ?string $countryCode = null,
        ?string $state = null,
        ?string $city = null,
        ?string $street = null,
    ) {
        $this->countryCode = $countryCode;
        $this->state = $state;
        $this->city = $city;
        $this->street = $street;
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

    public function getStreet(): ?string {
        return $this->street;
    }

    public function setStreet(?string $value): self {
        $this->street = $value;
        return $this;
    }

}
