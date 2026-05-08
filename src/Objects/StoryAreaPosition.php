<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes the position of a clickable area within a story.
 * @link https://core.telegram.org/bots/api#storyareaposition
 */
final class StoryAreaPosition extends AbstractObject {

    /**
     * X Percentage
     *
     * The abscissa of the area's center, as a percentage of the media width
     * @var float|null
     */
    protected ?float $xPercentage = null;

    /**
     * Y Percentage
     *
     * The ordinate of the area's center, as a percentage of the media height
     * @var float|null
     */
    protected ?float $yPercentage = null;

    /**
     * Width Percentage
     *
     * The width of the area's rectangle, as a percentage of the media width
     * @var float|null
     */
    protected ?float $widthPercentage = null;

    /**
     * Height Percentage
     *
     * The height of the area's rectangle, as a percentage of the media height
     * @var float|null
     */
    protected ?float $heightPercentage = null;

    /**
     * Rotation Angle
     *
     * The clockwise rotation angle of the rectangle, in degrees; 0-360
     * @var float|null
     */
    protected ?float $rotationAngle = null;

    /**
     * Corner Radius Percentage
     *
     * The radius of the rectangle corner rounding, as a percentage of the media width
     * @var float|null
     */
    protected ?float $cornerRadiusPercentage = null;

    public static function fromArray(array $data): StoryAreaPosition {
        $instance = new self();
        if (isset($data['x_percentage'])) {
            $instance->xPercentage = $data['x_percentage'];
        }
        if (isset($data['y_percentage'])) {
            $instance->yPercentage = $data['y_percentage'];
        }
        if (isset($data['width_percentage'])) {
            $instance->widthPercentage = $data['width_percentage'];
        }
        if (isset($data['height_percentage'])) {
            $instance->heightPercentage = $data['height_percentage'];
        }
        if (isset($data['rotation_angle'])) {
            $instance->rotationAngle = $data['rotation_angle'];
        }
        if (isset($data['corner_radius_percentage'])) {
            $instance->cornerRadiusPercentage = $data['corner_radius_percentage'];
        }
        return $instance;
    }

    public function __construct(
        ?float $xPercentage = null,
        ?float $yPercentage = null,
        ?float $widthPercentage = null,
        ?float $heightPercentage = null,
        ?float $rotationAngle = null,
        ?float $cornerRadiusPercentage = null,
    ) {
        $this->xPercentage = $xPercentage;
        $this->yPercentage = $yPercentage;
        $this->widthPercentage = $widthPercentage;
        $this->heightPercentage = $heightPercentage;
        $this->rotationAngle = $rotationAngle;
        $this->cornerRadiusPercentage = $cornerRadiusPercentage;
    }

    public function getXPercentage(): ?float {
        return $this->xPercentage;
    }

    public function setXPercentage(?float $value): self {
        $this->xPercentage = $value;
        return $this;
    }

    public function getYPercentage(): ?float {
        return $this->yPercentage;
    }

    public function setYPercentage(?float $value): self {
        $this->yPercentage = $value;
        return $this;
    }

    public function getWidthPercentage(): ?float {
        return $this->widthPercentage;
    }

    public function setWidthPercentage(?float $value): self {
        $this->widthPercentage = $value;
        return $this;
    }

    public function getHeightPercentage(): ?float {
        return $this->heightPercentage;
    }

    public function setHeightPercentage(?float $value): self {
        $this->heightPercentage = $value;
        return $this;
    }

    public function getRotationAngle(): ?float {
        return $this->rotationAngle;
    }

    public function setRotationAngle(?float $value): self {
        $this->rotationAngle = $value;
        return $this;
    }

    public function getCornerRadiusPercentage(): ?float {
        return $this->cornerRadiusPercentage;
    }

    public function setCornerRadiusPercentage(?float $value): self {
        $this->cornerRadiusPercentage = $value;
        return $this;
    }

}
