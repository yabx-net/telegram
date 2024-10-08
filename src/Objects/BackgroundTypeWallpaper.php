<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BackgroundTypeWallpaper extends BackgroundType {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the background, always “wallpaper”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Document
     *
     * Document with the wallpaper
     * @var Document|null
     */
    protected ?Document $document = null;

    /**
     * Dark Theme Dimming
     *
     * Dimming of the background in dark themes, as a percentage; 0-100
     * @var int|null
     */
    protected ?int $darkThemeDimming = null;

    /**
     * Is Blurred
     *
     * Optional. True, if the wallpaper is downscaled to fit in a 450x450 square and then box-blurred with radius 12
     * @var bool|null
     */
    protected ?bool $isBlurred = null;

    /**
     * Is Moving
     *
     * Optional. True, if the background moves slightly when the device is tilted
     * @var bool|null
     */
    protected ?bool $isMoving = null;

    public function __construct(
        ?string   $type = null,
        ?Document $document = null,
        ?int      $darkThemeDimming = null,
        ?bool     $isBlurred = null,
        ?bool     $isMoving = null,
    ) {
        $this->type = $type;
        $this->document = $document;
        $this->darkThemeDimming = $darkThemeDimming;
        $this->isBlurred = $isBlurred;
        $this->isMoving = $isMoving;
    }

    public static function fromArray(array $data): BackgroundTypeWallpaper {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['document'])) {
            $instance->document = Document::fromArray($data['document']);
        }
        if (isset($data['dark_theme_dimming'])) {
            $instance->darkThemeDimming = $data['dark_theme_dimming'];
        }
        if (isset($data['is_blurred'])) {
            $instance->isBlurred = $data['is_blurred'];
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

    public function getDarkThemeDimming(): ?int {
        return $this->darkThemeDimming;
    }

    public function setDarkThemeDimming(?int $value): self {
        $this->darkThemeDimming = $value;
        return $this;
    }

    public function getIsBlurred(): ?bool {
        return $this->isBlurred;
    }

    public function setIsBlurred(?bool $value): self {
        $this->isBlurred = $value;
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
