<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents a location to be sent.
 * @link https://core.telegram.org/bots/api#inputmedialocation
 */
final class InputMediaLocation extends InputMedia implements InputPollMedia, InputPollOptionMedia {

    /**
     * Type
     *
     * Type of the result, must be location
     * @var string
     */
    protected string $type = 'location';

    /**
     * Latitude
     *
     * Latitude of the location
     * @var float|null
     */
    protected ?float $latitude = null;

    /**
     * Longitude
     *
     * Longitude of the location
     * @var float|null
     */
    protected ?float $longitude = null;

    /**
     * Horizontal Accuracy
     *
     * Optional. The radius of uncertainty for the location, measured in meters.
     * @var float|null
     */
    protected ?float $horizontalAccuracy = null;

    public function __construct(
        ?float $latitude = null,
        ?float $longitude = null,
        ?float $horizontalAccuracy = null,
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->horizontalAccuracy = $horizontalAccuracy;
    }

    public static function fromArray(array $data): InputMediaLocation {
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
        if (isset($data['horizontal_accuracy'])) {
            $instance->horizontalAccuracy = $data['horizontal_accuracy'];
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

    public function getHorizontalAccuracy(): ?float {
        return $this->horizontalAccuracy;
    }

    public function setHorizontalAccuracy(?float $value): self {
        $this->horizontalAccuracy = $value;
        return $this;
    }

}
