<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents a venue to be sent.
 * @link https://core.telegram.org/bots/api#inputmediavenue
 */
final class InputMediaVenue extends InputMedia implements InputPollMedia, InputPollOptionMedia {

    /**
     * Type
     *
     * Type of the result, must be venue
     * @var string
     */
    protected string $type = 'venue';

    /**
     * Latitude
     *
     * Latitude of the venue
     * @var float|null
     */
    protected ?float $latitude = null;

    /**
     * Longitude
     *
     * Longitude of the venue
     * @var float|null
     */
    protected ?float $longitude = null;

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
     * Optional. Foursquare type of the venue
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
     * Optional. Google Places type of the venue
     * @var string|null
     */
    protected ?string $googlePlaceType = null;

    public function __construct(
        ?float $latitude = null,
        ?float $longitude = null,
        ?string $title = null,
        ?string $address = null,
        ?string $foursquareId = null,
        ?string $foursquareType = null,
        ?string $googlePlaceId = null,
        ?string $googlePlaceType = null,
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->title = $title;
        $this->address = $address;
        $this->foursquareId = $foursquareId;
        $this->foursquareType = $foursquareType;
        $this->googlePlaceId = $googlePlaceId;
        $this->googlePlaceType = $googlePlaceType;
    }

    public static function fromArray(array $data): InputMediaVenue {
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

    public function getType(): string {
        return $this->type;
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
