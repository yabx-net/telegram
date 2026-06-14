<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents a media in a poll.
 * @link https://core.telegram.org/bots/api#pollmedia
 */
final class PollMedia extends AbstractObject {

    /**
     * Animation
     *
     * Optional. Animation content of the poll media
     * @var Animation|null
     */
    protected ?Animation $animation = null;

    /**
     * Audio
     *
     * Optional. Audio content of the poll media
     * @var Audio|null
     */
    protected ?Audio $audio = null;

    /**
     * Document
     *
     * Optional. Document content of the poll media
     * @var Document|null
     */
    protected ?Document $document = null;

    /**
     * Link
     *
     * Optional. The HTTP link attached to the poll option
     * @var Link|null
     */
    protected ?Link $link = null;

    /**
     * Live Photo
     *
     * Optional. Live photo content of the poll media
     * @var LivePhoto|null
     */
    protected ?LivePhoto $livePhoto = null;

    /**
     * Location
     *
     * Optional. Location content of the poll media
     * @var Location|null
     */
    protected ?Location $location = null;

    /**
     * Photo
     *
     * Optional. Photo content of the poll media
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    /**
     * Sticker
     *
     * Optional. Sticker content of the poll media
     * @var Sticker|null
     */
    protected ?Sticker $sticker = null;

    /**
     * Venue
     *
     * Optional. Venue content of the poll media
     * @var Venue|null
     */
    protected ?Venue $venue = null;

    /**
     * Video
     *
     * Optional. Video content of the poll media
     * @var Video|null
     */
    protected ?Video $video = null;

    public function __construct(
        ?Animation $animation = null,
        ?Audio $audio = null,
        ?Document $document = null,
        ?Link $link = null,
        ?LivePhoto $livePhoto = null,
        ?Location $location = null,
        ?array $photo = null,
        ?Sticker $sticker = null,
        ?Venue $venue = null,
        ?Video $video = null,
    ) {
        $this->animation = $animation;
        $this->audio = $audio;
        $this->document = $document;
        $this->link = $link;
        $this->livePhoto = $livePhoto;
        $this->location = $location;
        $this->photo = $photo;
        $this->sticker = $sticker;
        $this->venue = $venue;
        $this->video = $video;
    }

    public static function fromArray(array $data): PollMedia {
        $instance = new self();
        if (isset($data['animation'])) {
            $instance->animation = Animation::fromArray($data['animation']);
        }
        if (isset($data['audio'])) {
            $instance->audio = Audio::fromArray($data['audio']);
        }
        if (isset($data['document'])) {
            $instance->document = Document::fromArray($data['document']);
        }
        if (isset($data['link'])) {
            $instance->link = Link::fromArray($data['link']);
        }
        if (isset($data['live_photo'])) {
            $instance->livePhoto = LivePhoto::fromArray($data['live_photo']);
        }
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        if (isset($data['sticker'])) {
            $instance->sticker = Sticker::fromArray($data['sticker']);
        }
        if (isset($data['venue'])) {
            $instance->venue = Venue::fromArray($data['venue']);
        }
        if (isset($data['video'])) {
            $instance->video = Video::fromArray($data['video']);
        }
        return $instance;
    }

    public function getAnimation(): ?Animation {
        return $this->animation;
    }

    public function setAnimation(?Animation $value): self {
        $this->animation = $value;
        return $this;
    }

    public function getAudio(): ?Audio {
        return $this->audio;
    }

    public function setAudio(?Audio $value): self {
        $this->audio = $value;
        return $this;
    }

    public function getDocument(): ?Document {
        return $this->document;
    }

    public function setDocument(?Document $value): self {
        $this->document = $value;
        return $this;
    }

    public function getLink(): ?Link {
        return $this->link;
    }

    public function setLink(?Link $value): self {
        $this->link = $value;
        return $this;
    }

    public function getLivePhoto(): ?LivePhoto {
        return $this->livePhoto;
    }

    public function setLivePhoto(?LivePhoto $value): self {
        $this->livePhoto = $value;
        return $this;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

    public function getSticker(): ?Sticker {
        return $this->sticker;
    }

    public function setSticker(?Sticker $value): self {
        $this->sticker = $value;
        return $this;
    }

    public function getVenue(): ?Venue {
        return $this->venue;
    }

    public function setVenue(?Venue $value): self {
        $this->venue = $value;
        return $this;
    }

    public function getVideo(): ?Video {
        return $this->video;
    }

    public function setVideo(?Video $value): self {
        $this->video = $value;
        return $this;
    }

}
