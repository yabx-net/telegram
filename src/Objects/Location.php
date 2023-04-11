<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Location {

    use ObjectTrait;

    /**
     * Longitude
     *
     * Longitude as defined by sender
     * @var float|null
     */
    protected ?float $longitude = null;

    /**
     * Latitude
     *
     * Latitude as defined by sender
     * @var float|null
     */
    protected ?float $latitude = null;

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

    public function __construct(
        ?float $longitude = null,
        ?float $latitude = null,
        ?float $horizontalAccuracy = null,
        ?int   $livePeriod = null,
        ?int   $heading = null,
        ?int   $proximityAlertRadius = null,
    ) {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->horizontalAccuracy = $horizontalAccuracy;
        $this->livePeriod = $livePeriod;
        $this->heading = $heading;
        $this->proximityAlertRadius = $proximityAlertRadius;
    }

    public static function fromArray(array $data): Location {
        $instance = new self();
        if (isset($data['longitude'])) {
            $instance->longitude = $data['longitude'];
        }
        if (isset($data['latitude'])) {
            $instance->latitude = $data['latitude'];
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

    public function getLongitude(): ?float {
        return $this->longitude;
    }

    public function setLongitude(?float $value): self {
        $this->longitude = $value;
        return $this;
    }

    public function getLatitude(): ?float {
        return $this->latitude;
    }

    public function setLatitude(?float $value): self {
        $this->latitude = $value;
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
