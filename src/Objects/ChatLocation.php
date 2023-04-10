<?php

namespace Yabx\Telegram\Objects;

class ChatLocation {

    /**
     * Location
     *
     * The location to which the supergroup is connected. Can't be a live location.
     * @var Location
     */
    protected Location $location;

    /**
     * Address
     *
     * Location address; 1-64 characters, as defined by the chat owner
     * @var string
     */
    protected string $address;


    public function __construct(array $data) {
        if (isset($data['location'])) {
            $this->location = new Location($data['location']);
        }
        if (isset($data['address'])) {
            $this->address = $data['address'];
        }
    }

    public function getLocation(): Location {
        return $this->location;
    }

    public function getAddress(): string {
        return $this->address;
    }


}
