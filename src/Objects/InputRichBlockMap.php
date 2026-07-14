<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with a map, corresponding to the custom HTML tag <tg-map>. The map's width and height must not exceed 10000 in total. The width and height ratio must be at most 20.
 * @link https://core.telegram.org/bots/api#inputrichblockmap
 */
final class InputRichBlockMap extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "map"
     * @var string
     */
    protected string $type = 'map';

    /**
     * Location
     *
     * Location of the center of the map
     * @var Location|null
     */
    protected ?Location $location = null;

    /**
     * Zoom
     *
     * Map zoom level; 0-24
     * @var int|null
     */
    protected ?int $zoom = null;

    /**
     * Width
     *
     * Map width; 0-10000
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Map height; 0-10000
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
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

    public static function fromArray(array $data): InputRichBlockMap {
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
