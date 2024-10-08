<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PaidMediaVideo extends PaidMedia {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the paid media, always “video”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Video
     *
     * The video
     * @var Video|null
     */
    protected ?Video $video = null;

    public function __construct(
        ?string $type = null,
        ?Video  $video = null,
    ) {
        $this->type = $type;
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

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
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
