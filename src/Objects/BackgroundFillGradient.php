<?php

namespace Yabx\Telegram\Objects;

final class BackgroundFillGradient extends AbstractObject {

    /**
     * Type
     *
     * Type of the background fill, always “gradient”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Top Color
     *
     * Top color of the gradient in the RGB24 format
     * @var int|null
     */
    protected ?int $topColor = null;

    /**
     * Bottom Color
     *
     * Bottom color of the gradient in the RGB24 format
     * @var int|null
     */
    protected ?int $bottomColor = null;

    /**
     * Rotation Angle
     *
     * Clockwise rotation angle of the background fill in degrees; 0-359
     * @var int|null
     */
    protected ?int $rotationAngle = null;

    public function __construct(
        ?string $type = null,
        ?int    $topColor = null,
        ?int    $bottomColor = null,
        ?int    $rotationAngle = null,
    ) {
        $this->type = $type;
        $this->topColor = $topColor;
        $this->bottomColor = $bottomColor;
        $this->rotationAngle = $rotationAngle;
    }

    public static function fromArray(array $data): BackgroundFillGradient {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['top_color'])) {
            $instance->topColor = $data['top_color'];
        }
        if (isset($data['bottom_color'])) {
            $instance->bottomColor = $data['bottom_color'];
        }
        if (isset($data['rotation_angle'])) {
            $instance->rotationAngle = $data['rotation_angle'];
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

    public function getTopColor(): ?int {
        return $this->topColor;
    }

    public function setTopColor(?int $value): self {
        $this->topColor = $value;
        return $this;
    }

    public function getBottomColor(): ?int {
        return $this->bottomColor;
    }

    public function setBottomColor(?int $value): self {
        $this->bottomColor = $value;
        return $this;
    }

    public function getRotationAngle(): ?int {
        return $this->rotationAngle;
    }

    public function setRotationAngle(?int $value): self {
        $this->rotationAngle = $value;
        return $this;
    }

}
