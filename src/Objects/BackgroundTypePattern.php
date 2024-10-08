<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BackgroundTypePattern extends BackgroundType {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the background, always “pattern”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Document
     *
     * Document with the pattern
     * @var Document|null
     */
    protected ?Document $document = null;

    /**
     * Fill
     *
     * The background fill that is combined with the pattern
     * @var BackgroundFill|null
     */
    protected ?BackgroundFill $fill = null;

    /**
     * Intensity
     *
     * Intensity of the pattern when it is shown above the filled background; 0-100
     * @var int|null
     */
    protected ?int $intensity = null;

    /**
     * Is Inverted
     *
     * Optional. True, if the background fill must be applied only to the pattern itself. All other pixels are black in this case. For dark themes only
     * @var bool|null
     */
    protected ?bool $isInverted = null;

    /**
     * Is Moving
     *
     * Optional. True, if the background moves slightly when the device is tilted
     * @var bool|null
     */
    protected ?bool $isMoving = null;

    public function __construct(
        ?string         $type = null,
        ?Document       $document = null,
        ?BackgroundFill $fill = null,
        ?int            $intensity = null,
        ?bool           $isInverted = null,
        ?bool           $isMoving = null,
    ) {
        $this->type = $type;
        $this->document = $document;
        $this->fill = $fill;
        $this->intensity = $intensity;
        $this->isInverted = $isInverted;
        $this->isMoving = $isMoving;
    }

    public static function fromArray(array $data): BackgroundTypePattern {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['document'])) {
            $instance->document = Document::fromArray($data['document']);
        }
        if (isset($data['fill'])) {
            $instance->fill = BackgroundFill::fromArray($data['fill']);
        }
        if (isset($data['intensity'])) {
            $instance->intensity = $data['intensity'];
        }
        if (isset($data['is_inverted'])) {
            $instance->isInverted = $data['is_inverted'];
        }
        if (isset($data['is_moving'])) {
            $instance->isMoving = $data['is_moving'];
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

    public function getDocument(): ?Document {
        return $this->document;
    }

    public function setDocument(?Document $value): self {
        $this->document = $value;
        return $this;
    }

    public function getFill(): ?BackgroundFill {
        return $this->fill;
    }

    public function setFill(?BackgroundFill $value): self {
        $this->fill = $value;
        return $this;
    }

    public function getIntensity(): ?int {
        return $this->intensity;
    }

    public function setIntensity(?int $value): self {
        $this->intensity = $value;
        return $this;
    }

    public function getIsInverted(): ?bool {
        return $this->isInverted;
    }

    public function setIsInverted(?bool $value): self {
        $this->isInverted = $value;
        return $this;
    }

    public function getIsMoving(): ?bool {
        return $this->isMoving;
    }

    public function setIsMoving(?bool $value): self {
        $this->isMoving = $value;
        return $this;
    }

}
