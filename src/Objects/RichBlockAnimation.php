<?php

namespace Yabx\Telegram\Objects;

final class RichBlockAnimation extends RichBlock {

    protected string $type = 'animation';

    protected ?Animation $animation = null;

    protected ?bool $hasSpoiler = null;

    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?Animation $animation = null,
        ?bool $hasSpoiler = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->animation = $animation;
        $this->hasSpoiler = $hasSpoiler;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockAnimation {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['animation'])) {
            $instance->animation = Animation::fromArray($data['animation']);
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

    public function getAnimation(): ?Animation {
        return $this->animation;
    }

    public function setAnimation(?Animation $value): self {
        $this->animation = $value;
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
