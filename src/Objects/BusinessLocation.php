<?php

namespace Yabx\Telegram\Objects;

final class BusinessLocation extends AbstractObject {

    /**
     * Address
     *
     * Address of the business
     * @var string|null
     */
    protected ?string $address = null;

    /**
     * Location
     *
     * Optional. Location of the business
     * @var Location|null
     */
    protected ?Location $location = null;

    public function __construct(
        ?string   $address = null,
        ?Location $location = null,
    ) {
        $this->address = $address;
        $this->location = $location;
    }

    public static function fromArray(array $data): BusinessLocation {
        $instance = new self();
        if (isset($data['address'])) {
            $instance->address = $data['address'];
        }
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        return $instance;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $value): self {
        $this->address = $value;
        return $this;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

}
