<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes a paid media with a live photo.
 * @link https://core.telegram.org/bots/api#paidmedialivephoto
 */
final class PaidMediaLivePhoto extends PaidMedia {

    /**
     * Type
     *
     * Type of the paid media, always “live_photo”
     * @var string
     */
    protected string $type = 'live_photo';

    /**
     * Live Photo
     *
     * The live photo
     * @var LivePhoto|null
     */
    protected ?LivePhoto $livePhoto = null;

    public function __construct(
        ?LivePhoto $livePhoto = null,
    ) {
        $this->livePhoto = $livePhoto;
    }

    public static function fromArray(array $data): PaidMediaLivePhoto {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['live_photo'])) {
            $instance->livePhoto = LivePhoto::fromArray($data['live_photo']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getLivePhoto(): ?LivePhoto {
        return $this->livePhoto;
    }

    public function setLivePhoto(?LivePhoto $value): self {
        $this->livePhoto = $value;
        return $this;
    }

}
