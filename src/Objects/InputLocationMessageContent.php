<?php

namespace Yabx\Telegram\Objects;

class InputLocationMessageContent {

    /**
     * Latitude
     *
     * Latitude of the location in degrees
     * @var float
     */
    protected float $latitude;

    /**
     * Longitude
     *
     * Longitude of the location in degrees
     * @var float
     */
    protected float $longitude;

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


    public function __construct(array $data) {
        if (isset($data['latitude'])) {
            $this->latitude = $data['latitude'];
        }
        if (isset($data['longitude'])) {
            $this->longitude = $data['longitude'];
        }
        if (isset($data['horizontal_accuracy'])) {
            $this->horizontalAccuracy = $data['horizontal_accuracy'];
        }
        if (isset($data['live_period'])) {
            $this->livePeriod = $data['live_period'];
        }
        if (isset($data['heading'])) {
            $this->heading = $data['heading'];
        }
        if (isset($data['proximity_alert_radius'])) {
            $this->proximityAlertRadius = $data['proximity_alert_radius'];
        }
    }

    public function getLatitude(): float {
        return $this->latitude;
    }

    public function getLongitude(): float {
        return $this->longitude;
    }

    public function getHorizontalAccuracy(): ?float {
        return $this->horizontalAccuracy;
    }

    public function getLivePeriod(): ?int {
        return $this->livePeriod;
    }

    public function getHeading(): ?int {
        return $this->heading;
    }

    public function getProximityAlertRadius(): ?int {
        return $this->proximityAlertRadius;
    }


}
