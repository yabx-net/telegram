<?php

namespace Yabx\Telegram\Objects;

final class RichBlockPhoto extends RichBlock {

    protected string $type = 'photo';

    protected ?array $photo = null;

    protected ?bool $hasSpoiler = null;

    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?array $photo = null,
        ?bool $hasSpoiler = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->photo = $photo;
        $this->hasSpoiler = $hasSpoiler;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockPhoto {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['photo'])) {
            $instance->photo = PhotoSize::arrayOf($data['photo']);
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

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
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
