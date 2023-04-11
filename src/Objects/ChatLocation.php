<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatLocation {

    use ObjectTrait;

    /**
     * Location
     *
     * The location to which the supergroup is connected. Can't be a live location.
     * @var Location|null
     */
    protected ?Location $location = null;

    /**
     * Address
     *
     * Location address; 1-64 characters, as defined by the chat owner
     * @var string|null
     */
    protected ?string $address = null;

    public function __construct(
        ?Location $location = null,
        ?string   $address = null,
    ) {
        $this->location = $location;
        $this->address = $address;
    }

    public static function fromArray(array $data): ChatLocation {
        $instance = new self();
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        if (isset($data['address'])) {
            $instance->address = $data['address'];
        }
        return $instance;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $value): self {
        $this->address = $value;
        return $this;
    }

}
