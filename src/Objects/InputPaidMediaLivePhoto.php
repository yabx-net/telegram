<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes a paid media with a live photo to be sent.
 * @link https://core.telegram.org/bots/api#inputpaidmedialivephoto
 */
final class InputPaidMediaLivePhoto extends InputPaidMedia {

    /**
     * Type
     *
     * Type of the media, must be live_photo
     * @var string
     */
    protected string $type = 'live_photo';

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers, pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one.
     * @var string|null
     */
    protected ?string $media = null;

    /**
     * Photo
     *
     * Photo image for the live photo.
     * @var string|null
     */
    protected ?string $photo = null;

    public static function fromArray(array $data): InputPaidMediaLivePhoto {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['media'])) {
            $instance->media = $data['media'];
        }
        if (isset($data['photo'])) {
            $instance->photo = $data['photo'];
        }
        return $instance;
    }

    public function __construct(
        ?string $media = null,
        ?string $photo = null,
    ) {
        $this->media = $media;
        $this->photo = $photo;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMedia(): ?string {
        return $this->media;
    }

    public function setMedia(?string $value): self {
        $this->media = $value;
        return $this;
    }

    public function getPhoto(): ?string {
        return $this->photo;
    }

    public function setPhoto(?string $value): self {
        $this->photo = $value;
        return $this;
    }

}
