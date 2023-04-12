<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultLocation extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be location
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 Bytes
     * @var string|null
     */
    protected ?string $id = null;

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
     * Title
     *
     * Location title
     * @var string|null
     */
    protected ?string $title = null;

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

    /**
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;

    /**
     * Input Message Content
     *
     * Optional. Content of the message to be sent instead of the location
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    /**
     * Thumbnail Url
     *
     * Optional. Url of the thumbnail for the result
     * @var string|null
     */
    protected ?string $thumbnailUrl = null;

    /**
     * Thumbnail Width
     *
     * Optional. Thumbnail width
     * @var int|null
     */
    protected ?int $thumbnailWidth = null;

    /**
     * Thumbnail Height
     *
     * Optional. Thumbnail height
     * @var int|null
     */
    protected ?int $thumbnailHeight = null;

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?float                $latitude = null,
        ?float                $longitude = null,
        ?string               $title = null,
        ?float                $horizontalAccuracy = null,
        ?int                  $livePeriod = null,
        ?int                  $heading = null,
        ?int                  $proximityAlertRadius = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
        ?string               $thumbnailUrl = null,
        ?int                  $thumbnailWidth = null,
        ?int                  $thumbnailHeight = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->title = $title;
        $this->horizontalAccuracy = $horizontalAccuracy;
        $this->livePeriod = $livePeriod;
        $this->heading = $heading;
        $this->proximityAlertRadius = $proximityAlertRadius;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    public static function fromArray(array $data): InlineQueryResultLocation {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
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
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $instance->inputMessageContent = InputMessageContent::fromArray($data['input_message_content']);
        }
        if (isset($data['thumbnail_url'])) {
            $instance->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_width'])) {
            $instance->thumbnailWidth = $data['thumbnail_width'];
        }
        if (isset($data['thumbnail_height'])) {
            $instance->thumbnailHeight = $data['thumbnail_height'];
        }
        return $instance;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
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

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
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

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $value): self {
        $this->replyMarkup = $value;
        return $this;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function setInputMessageContent(?InputMessageContent $value): self {
        $this->inputMessageContent = $value;
        return $this;
    }

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $value): self {
        $this->thumbnailUrl = $value;
        return $this;
    }

    public function getThumbnailWidth(): ?int {
        return $this->thumbnailWidth;
    }

    public function setThumbnailWidth(?int $value): self {
        $this->thumbnailWidth = $value;
        return $this;
    }

    public function getThumbnailHeight(): ?int {
        return $this->thumbnailHeight;
    }

    public function setThumbnailHeight(?int $value): self {
        $this->thumbnailHeight = $value;
        return $this;
    }

}
