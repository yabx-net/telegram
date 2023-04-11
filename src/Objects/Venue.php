<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Venue {

    use ObjectTrait;

    /**
     * Location
     *
     * Venue location. Can't be a live location
     * @var Location|null
     */
    protected ?Location $location = null;

    /**
     * Title
     *
     * Name of the venue
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Address
     *
     * Address of the venue
     * @var string|null
     */
    protected ?string $address = null;

    /**
     * Foursquare Id
     *
     * Optional. Foursquare identifier of the venue
     * @var string|null
     */
    protected ?string $foursquareId = null;

    /**
     * Foursquare Type
     *
     * Optional. Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     * @var string|null
     */
    protected ?string $foursquareType = null;

    /**
     * Google Place Id
     *
     * Optional. Google Places identifier of the venue
     * @var string|null
     */
    protected ?string $googlePlaceId = null;

    /**
     * Google Place Type
     *
     * Optional. Google Places type of the venue. (See supported types.)
     * @var string|null
     */
    protected ?string $googlePlaceType = null;

    public function __construct(
        ?Location $location = null,
        ?string   $title = null,
        ?string   $address = null,
        ?string   $foursquareId = null,
        ?string   $foursquareType = null,
        ?string   $googlePlaceId = null,
        ?string   $googlePlaceType = null,
    ) {
        $this->location = $location;
        $this->title = $title;
        $this->address = $address;
        $this->foursquareId = $foursquareId;
        $this->foursquareType = $foursquareType;
        $this->googlePlaceId = $googlePlaceId;
        $this->googlePlaceType = $googlePlaceType;
    }

    public static function fromArray(array $data): Venue {
        $instance = new self();
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['address'])) {
            $instance->address = $data['address'];
        }
        if (isset($data['foursquare_id'])) {
            $instance->foursquareId = $data['foursquare_id'];
        }
        if (isset($data['foursquare_type'])) {
            $instance->foursquareType = $data['foursquare_type'];
        }
        if (isset($data['google_place_id'])) {
            $instance->googlePlaceId = $data['google_place_id'];
        }
        if (isset($data['google_place_type'])) {
            $instance->googlePlaceType = $data['google_place_type'];
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

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $value): self {
        $this->address = $value;
        return $this;
    }

    public function getFoursquareId(): ?string {
        return $this->foursquareId;
    }

    public function setFoursquareId(?string $value): self {
        $this->foursquareId = $value;
        return $this;
    }

    public function getFoursquareType(): ?string {
        return $this->foursquareType;
    }

    public function setFoursquareType(?string $value): self {
        $this->foursquareType = $value;
        return $this;
    }

    public function getGooglePlaceId(): ?string {
        return $this->googlePlaceId;
    }

    public function setGooglePlaceId(?string $value): self {
        $this->googlePlaceId = $value;
        return $this;
    }

    public function getGooglePlaceType(): ?string {
        return $this->googlePlaceType;
    }

    public function setGooglePlaceType(?string $value): self {
        $this->googlePlaceType = $value;
        return $this;
    }

}
