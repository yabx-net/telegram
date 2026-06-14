<?php

namespace Yabx\Telegram\Objects;

final class RichBlockVideo extends RichBlock {

    protected string $type = 'video';

    protected ?Video $video = null;

    protected ?bool $hasSpoiler = null;

    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?Video $video = null,
        ?bool $hasSpoiler = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->video = $video;
        $this->hasSpoiler = $hasSpoiler;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockVideo {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['video'])) {
            $instance->video = Video::fromArray($data['video']);
        }
        if (isset($data['has_spoiler'])) {
            $instance->hasSpoiler = $data['has_spoiler'];
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
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

    public function getHasSpoiler(): ?bool {
        return $this->hasSpoiler;
    }

    public function setHasSpoiler(?bool $value): self {
        $this->hasSpoiler = $value;
        return $this;
    }

    public function getCaption(): ?RichBlockCaption {
        return $this->caption;
    }

    public function setCaption(?RichBlockCaption $value): self {
        $this->caption = $value;
        return $this;
    }
}
