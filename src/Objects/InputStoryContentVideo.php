<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a video to post as a story.
 * @link https://core.telegram.org/bots/api#inputstorycontentvideo
 */
final class InputStoryContentVideo extends InputStoryContent {

    /**
     * Type
     *
     * Type of the content, must be video
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Video
     *
     * The video to post as a story. The video must be of the size 720x1280, streamable, encoded with H.265 codec, with key frames added each second in the MPEG4 format, and must not exceed 30 MB. The video can't be reused and can only be uploaded as a new file, so you can pass “attach://<file_attach_name>” if the video was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @var string|null
     */
    protected ?string $video = null;

    /**
     * Duration
     *
     * Optional. Precise duration of the video in seconds; 0-60
     * @var float|null
     */
    protected ?float $duration = null;

    /**
     * Cover Frame Timestamp
     *
     * Optional. Timestamp in seconds of the frame that will be used as the static cover for the story. Defaults to 0.0.
     * @var float|null
     */
    protected ?float $coverFrameTimestamp = null;

    /**
     * Is Animation
     *
     * Optional. Pass True if the video has no sound
     * @var bool|null
     */
    protected ?bool $isAnimation = null;

    public static function fromArray(array $data): InputStoryContentVideo {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['video'])) {
            $instance->video = $data['video'];
        }
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        if (isset($data['cover_frame_timestamp'])) {
            $instance->coverFrameTimestamp = $data['cover_frame_timestamp'];
        }
        if (isset($data['is_animation'])) {
            $instance->isAnimation = $data['is_animation'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $video = null,
        ?float $duration = null,
        ?float $coverFrameTimestamp = null,
        ?bool $isAnimation = null,
    ) {
        $this->type = $type;
        $this->video = $video;
        $this->duration = $duration;
        $this->coverFrameTimestamp = $coverFrameTimestamp;
        $this->isAnimation = $isAnimation;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getVideo(): ?string {
        return $this->video;
    }

    public function setVideo(?string $value): self {
        $this->video = $value;
        return $this;
    }

    public function getDuration(): ?float {
        return $this->duration;
    }

    public function setDuration(?float $value): self {
        $this->duration = $value;
        return $this;
    }

    public function getCoverFrameTimestamp(): ?float {
        return $this->coverFrameTimestamp;
    }

    public function setCoverFrameTimestamp(?float $value): self {
        $this->coverFrameTimestamp = $value;
        return $this;
    }

    public function getIsAnimation(): ?bool {
        return $this->isAnimation;
    }

    public function setIsAnimation(?bool $value): self {
        $this->isAnimation = $value;
        return $this;
    }

}
