<?php

namespace Yabx\Telegram\Objects;

final class RichBlockMap extends RichBlock {

    protected string $type = 'map';

    protected ?Location $location = null;

    protected ?int $zoom = null;

    protected ?int $width = null;

    protected ?int $height = null;

    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?Location $location = null,
        ?int $zoom = null,
        ?int $width = null,
        ?int $height = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->location = $location;
        $this->zoom = $zoom;
        $this->width = $width;
        $this->height = $height;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockMap {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        if (isset($data['zoom'])) {
            $instance->zoom = $data['zoom'];
        }
        if (isset($data['width'])) {
            $instance->width = $data['width'];
        }
        if (isset($data['height'])) {
            $instance->height = $data['height'];
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

    public function getZoom(): ?int {
        return $this->zoom;
    }

    public function setZoom(?int $value): self {
        $this->zoom = $value;
        return $this;
    }

    public function getWidth(): ?int {
        return $this->width;
    }

    public function setWidth(?int $value): self {
        $this->width = $value;
        return $this;
    }

    public function getHeight(): ?int {
        return $this->height;
    }

    public function setHeight(?int $value): self {
        $this->height = $value;
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
