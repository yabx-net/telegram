<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MaskPosition {

    use ObjectTrait;

    /**
     * Point
     *
     * The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”.
     * @var string|null
     */
    protected ?string $point = null;

    /**
     * X Shift
     *
     * Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
     * @var float|null
     */
    protected ?float $xShift = null;

    /**
     * Y Shift
     *
     * Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
     * @var float|null
     */
    protected ?float $yShift = null;

    /**
     * Scale
     *
     * Mask scaling coefficient. For example, 2.0 means double size.
     * @var float|null
     */
    protected ?float $scale = null;

    public static function fromArray(array $data): MaskPosition {
        $instance = new self();
        if (isset($data['point'])) {
            $instance->point = $data['point'];
        }
        if (isset($data['x_shift'])) {
            $instance->xShift = $data['x_shift'];
        }
        if (isset($data['y_shift'])) {
            $instance->yShift = $data['y_shift'];
        }
        if (isset($data['scale'])) {
            $instance->scale = $data['scale'];
        }
        return $instance;
    }

    public function __construct(
        ?string $point = null,
        ?float  $xShift = null,
        ?float  $yShift = null,
        ?float  $scale = null,
    ) {
        $this->point = $point;
        $this->xShift = $xShift;
        $this->yShift = $yShift;
        $this->scale = $scale;
    }

    public function getPoint(): ?string {
        return $this->point;
    }

    public function setPoint(?string $value): self {
        $this->point = $value;
        return $this;
    }

    public function getXShift(): ?float {
        return $this->xShift;
    }

    public function setXShift(?float $value): self {
        $this->xShift = $value;
        return $this;
    }

    public function getYShift(): ?float {
        return $this->yShift;
    }

    public function setYShift(?float $value): self {
        $this->yShift = $value;
        return $this;
    }

    public function getScale(): ?float {
        return $this->scale;
    }

    public function setScale(?float $value): self {
        $this->scale = $value;
        return $this;
    }

}
