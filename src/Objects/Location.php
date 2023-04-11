<?php

namespace Yabx\Telegram\Objects;

class Location {

    /**
     * Longitude
     *
     * Longitude as defined by sender
     * @var float
     */
    protected float $longitude;

    /**
     * Latitude
     *
     * Latitude as defined by sender
     * @var float
     */
    protected float $latitude;

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
     * Optional. Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
     * @var int|null
     */
    protected ?int $livePeriod = null;

    /**
     * Heading
     *
     * Optional. The direction in which user is moving, in degrees; 1-360. For active live locations only.
     * @var int|null
     */
    protected ?int $heading = null;

    /**
     * Proximity Alert Radius
     *
     * Optional. The maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
     * @var int|null
     */
    protected ?int $proximityAlertRadius = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['longitude'])) {
            $this->longitude = $data['longitude'];
        }
        if (isset($data['latitude'])) {
            $this->latitude = $data['latitude'];
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

    public function getLongitude(): float {
        return $this->longitude;
    }

    public function getLatitude(): float {
        return $this->latitude;
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

    public function getRawData(): array {
        return $this->rawData;
    }

}
