<?php

namespace Yabx\Telegram\Objects;

class MaskPosition {

    /**
     * Point
     *
     * The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”.
     * @var string
     */
    protected string $point;

    /**
     * X Shift
     *
     * Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
     * @var float
     */
    protected float $xShift;

    /**
     * Y Shift
     *
     * Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
     * @var float
     */
    protected float $yShift;

    /**
     * Scale
     *
     * Mask scaling coefficient. For example, 2.0 means double size.
     * @var float
     */
    protected float $scale;


    public function __construct(array $data) {
        if (isset($data['point'])) {
            $this->point = $data['point'];
        }
        if (isset($data['x_shift'])) {
            $this->xShift = $data['x_shift'];
        }
        if (isset($data['y_shift'])) {
            $this->yShift = $data['y_shift'];
        }
        if (isset($data['scale'])) {
            $this->scale = $data['scale'];
        }
    }

    public function getPoint(): string {
        return $this->point;
    }

    public function getXShift(): float {
        return $this->xShift;
    }

    public function getYShift(): float {
        return $this->yShift;
    }

    public function getScale(): float {
        return $this->scale;
    }


}
