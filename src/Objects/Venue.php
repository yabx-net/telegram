<?php

namespace Yabx\Telegram\Objects;

class Venue {

    /**
     * Location
     *
     * Venue location. Can't be a live location
     * @var Location
     */
    protected Location $location;

    /**
     * Title
     *
     * Name of the venue
     * @var string
     */
    protected string $title;

    /**
     * Address
     *
     * Address of the venue
     * @var string
     */
    protected string $address;

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


    public function __construct(array $data) {
        if (isset($data['location'])) {
            $this->location = new Location($data['location']);
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['address'])) {
            $this->address = $data['address'];
        }
        if (isset($data['foursquare_id'])) {
            $this->foursquareId = $data['foursquare_id'];
        }
        if (isset($data['foursquare_type'])) {
            $this->foursquareType = $data['foursquare_type'];
        }
        if (isset($data['google_place_id'])) {
            $this->googlePlaceId = $data['google_place_id'];
        }
        if (isset($data['google_place_type'])) {
            $this->googlePlaceType = $data['google_place_type'];
        }
    }

    public function getLocation(): Location {
        return $this->location;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getFoursquareId(): ?string {
        return $this->foursquareId;
    }

    public function getFoursquareType(): ?string {
        return $this->foursquareType;
    }

    public function getGooglePlaceId(): ?string {
        return $this->googlePlaceId;
    }

    public function getGooglePlaceType(): ?string {
        return $this->googlePlaceType;
    }


}
