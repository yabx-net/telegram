<?php

namespace Yabx\Telegram\Objects;

final class InputLocationMessageContent extends InputMessageContent {

    /**
     * Latitude
     *
     * Latitude of the location in degrees
     * @var float|null
     */
    protected ?float $latitude = null;

    /**
     * Longitude
     *
     * Longitude of the location in degrees
     * @var float|null
     */
    protected ?float $longitude = null;

    /**
     * Horizontal Accuracy
     *
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @var float|null
     */
    protected ?float $horizontalAccuracy = null;

    /**
     * Live Period
     *
     * Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     * @var int|null
     */
    protected ?int $livePeriod = null;

    /**
     * Heading
     *
     * Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @var int|null
     */
    protected ?int $heading = null;

    /**
     * Proximity Alert Radius
     *
     * Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @var int|null
     */
    protected ?int $proximityAlertRadius = null;

    public function __construct(
        ?float $latitude = null,
        ?float $longitude = null,
        ?float $horizontalAccuracy = null,
        ?int   $livePeriod = null,
        ?int   $heading = null,
        ?int   $proximityAlertRadius = null,
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->horizontalAccuracy = $horizontalAccuracy;
        $this->livePeriod = $livePeriod;
        $this->heading = $heading;
        $this->proximityAlertRadius = $proximityAlertRadius;
    }

    public static function fromArray(array $data): InputLocationMessageContent {
        $instance = new self();
        if (isset($data['latitude'])) {
            $instance->latitude = $data['latitude'];
        }
        if (isset($data['longitude'])) {
            $instance->longitude = $data['longitude'];
        }
        if (isset($data['horizontal_accuracy'])) {
            $instance->horizontalAccuracy = $data['horizontal_accuracy'];
        }
        if (isset($data['live_period'])) {
            $instance->livePeriod = $data['live_period'];
        }
        if (isset($data['heading'])) {
            $instance->heading = $data['heading'];
        }
        if (isset($data['proximity_alert_radius'])) {
            $instance->proximityAlertRadius = $data['proximity_alert_radius'];
        }
        return $instance;
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

    public function getHorizontalAccuracy(): ?float {
        return $this->horizontalAccuracy;
    }

    public function setHorizontalAccuracy(?float $value): self {
        $this->horizontalAccuracy = $value;
        return $this;
    }

    public function getLivePeriod(): ?int {
        return $this->livePeriod;
    }

    public function setLivePeriod(?int $value): self {
        $this->livePeriod = $value;
        return $this;
    }

    public function getHeading(): ?int {
        return $this->heading;
    }

    public function setHeading(?int $value): self {
        $this->heading = $value;
        return $this;
    }

    public function getProximityAlertRadius(): ?int {
        return $this->proximityAlertRadius;
    }

    public function setProximityAlertRadius(?int $value): self {
        $this->proximityAlertRadius = $value;
        return $this;
    }

}
