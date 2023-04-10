<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultVenue {

    /**
     * Type
     *
     * Type of the result, must be venue
     * @var string
     */
    protected string $type;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 Bytes
     * @var string
     */
    protected string $id;

    /**
     * Latitude
     *
     * Latitude of the venue location in degrees
     * @var float
     */
    protected float $latitude;

    /**
     * Longitude
     *
     * Longitude of the venue location in degrees
     * @var float
     */
    protected float $longitude;

    /**
     * Title
     *
     * Title of the venue
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


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['latitude'])) {
            $this->latitude = $data['latitude'];
        }
        if (isset($data['longitude'])) {
            $this->longitude = $data['longitude'];
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
        if (isset($data['reply_markup'])) {
            $this->replyMarkup = new InlineKeyboardMarkup($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $this->inputMessageContent = new InputMessageContent($data['input_message_content']);
        }
        if (isset($data['thumbnail_url'])) {
            $this->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_width'])) {
            $this->thumbnailWidth = $data['thumbnail_width'];
        }
        if (isset($data['thumbnail_height'])) {
            $this->thumbnailHeight = $data['thumbnail_height'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getLatitude(): float {
        return $this->latitude;
    }

    public function getLongitude(): float {
        return $this->longitude;
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

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function getThumbnailWidth(): ?int {
        return $this->thumbnailWidth;
    }

    public function getThumbnailHeight(): ?int {
        return $this->thumbnailHeight;
    }


}
