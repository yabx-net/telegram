<?php

namespace Yabx\Telegram\Objects;

/**
 * An animated profile photo in the MPEG4 format.
 * @link https://core.telegram.org/bots/api#inputprofilephotoanimated
 */
final class InputProfilePhotoAnimated extends InputProfilePhoto {

    /**
     * Type
     *
     * Type of the profile photo, must be animated
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Animation
     *
     * The animated profile photo. Profile photos can't be reused and can only be uploaded as a new file, so you can pass “attach://<file_attach_name>” if the photo was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @var string|null
     */
    protected ?string $animation = null;

    /**
     * Main Frame Timestamp
     *
     * Optional. Timestamp in seconds of the frame that will be used as the static profile photo. Defaults to 0.0.
     * @var float|null
     */
    protected ?float $mainFrameTimestamp = null;

    public static function fromArray(array $data): InputProfilePhotoAnimated {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['animation'])) {
            $instance->animation = $data['animation'];
        }
        if (isset($data['main_frame_timestamp'])) {
            $instance->mainFrameTimestamp = $data['main_frame_timestamp'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $animation = null,
        ?float $mainFrameTimestamp = null,
    ) {
        $this->type = $type;
        $this->animation = $animation;
        $this->mainFrameTimestamp = $mainFrameTimestamp;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getAnimation(): ?string {
        return $this->animation;
    }

    public function setAnimation(?string $value): self {
        $this->animation = $value;
        return $this;
    }

    public function getMainFrameTimestamp(): ?float {
        return $this->mainFrameTimestamp;
    }

    public function setMainFrameTimestamp(?float $value): self {
        $this->mainFrameTimestamp = $value;
        return $this;
    }

}
