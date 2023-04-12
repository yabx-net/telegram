<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultVenue extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be venue
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
     * Latitude of the venue location in degrees
     * @var float|null
     */
    protected ?float $latitude = null;

    /**
     * Longitude
     *
     * Longitude of the venue location in degrees
     * @var float|null
     */
    protected ?float $longitude = null;

    /**
     * Title
     *
     * Title of the venue
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
     * Optional. Foursquare identifier of the venue if known
     * @var string|null
     */
    protected ?string $foursquareId = null;

    /**
     * Foursquare Type
     *
     * Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
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
     * Optional. Content of the message to be sent instead of the venue
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
        ?string               $address = null,
        ?string               $foursquareId = null,
        ?string               $foursquareType = null,
        ?string               $googlePlaceId = null,
        ?string               $googlePlaceType = null,
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
        $this->address = $address;
        $this->foursquareId = $foursquareId;
        $this->foursquareType = $foursquareType;
        $this->googlePlaceId = $googlePlaceId;
        $this->googlePlaceType = $googlePlaceType;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    public static function fromArray(array $data): InlineQueryResultVenue {
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
