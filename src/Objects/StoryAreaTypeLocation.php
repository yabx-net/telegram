<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a story area pointing to a location. Currently, a story can have up to 10 location areas.
 * @link https://core.telegram.org/bots/api#storyareatypelocation
 */
final class StoryAreaTypeLocation extends StoryAreaType {

    /**
     * Type
     *
     * Type of the area, always “location”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Latitude
     *
     * Location latitude in degrees
     * @var float|null
     */
    protected ?float $latitude = null;

    /**
     * Longitude
     *
     * Location longitude in degrees
     * @var float|null
     */
    protected ?float $longitude = null;

    /**
     * Address
     *
     * Optional. Address of the location
     * @var LocationAddress|null
     */
    protected ?LocationAddress $address = null;

    public static function fromArray(array $data): StoryAreaTypeLocation {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['latitude'])) {
            $instance->latitude = $data['latitude'];
        }
        if (isset($data['longitude'])) {
            $instance->longitude = $data['longitude'];
        }
        if (isset($data['address'])) {
            $instance->address = LocationAddress::fromArray($data['address']);
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?float $latitude = null,
        ?float $longitude = null,
        ?LocationAddress $address = null,
    ) {
        $this->type = $type;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->address = $address;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getLatitude(): ?float {
        return $this->latitude;
    }

    public function setLatitude(?float $value): self {
        $this->latitude = $value;
        return $this;
    }

    public function getLongitude(): ?float {
        return $this->longitude;
    }

    public function setLongitude(?float $value): self {
        $this->longitude = $value;
        return $this;
    }

    public function getAddress(): ?LocationAddress {
        return $this->address;
    }

    public function setAddress(?LocationAddress $value): self {
        $this->address = $value;
        return $this;
    }

}
