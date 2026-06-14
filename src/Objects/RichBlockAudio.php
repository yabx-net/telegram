<?php

namespace Yabx\Telegram\Objects;

final class RichBlockAudio extends RichBlock {

    protected string $type = 'audio';

    protected ?Audio $audio = null;

    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?Audio $audio = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->audio = $audio;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockAudio {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['audio'])) {
            $instance->audio = Audio::fromArray($data['audio']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getAudio(): ?Audio {
        return $this->audio;
    }

    public function setAudio(?Audio $value): self {
        $this->audio = $value;
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
