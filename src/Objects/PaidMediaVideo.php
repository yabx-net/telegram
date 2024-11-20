<?php

namespace Yabx\Telegram\Objects;

final class PaidMediaVideo extends PaidMedia {

    /**
     * Type
     *
     * Type of the paid media, always “video”
     * @var string
     */
    protected string $type = 'video';

    /**
     * Video
     *
     * The video
     * @var Video|null
     */
    protected ?Video $video = null;

    public function __construct(
        ?Video  $video = null,
    ) {
        $this->video = $video;
    }

    public static function fromArray(array $data): PaidMediaVideo {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['video'])) {
            $instance->video = Video::fromArray($data['video']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getVideo(): ?Video {
        return $this->video;
    }

    public function setVideo(?Video $value): self {
        $this->video = $value;
        return $this;
    }

}
