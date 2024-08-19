<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BackgroundTypeFill extends BackgroundType {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the background, always “fill”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Fill
     *
     * The background fill
     * @var BackgroundFill|null
     */
    protected ?BackgroundFill $fill = null;

    /**
     * Dark Theme Dimming
     *
     * Dimming of the background in dark themes, as a percentage; 0-100
     * @var int|null
     */
    protected ?int $darkThemeDimming = null;

    public static function fromArray(array $data): BackgroundTypeFill {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['fill'])) {
            $instance->fill = BackgroundFill::fromArray($data['fill']);
        }
        if (isset($data['dark_theme_dimming'])) {
            $instance->darkThemeDimming = $data['dark_theme_dimming'];
        }
        return $instance;
    }

    public function __construct(
        ?string         $type = null,
        ?BackgroundFill $fill = null,
        ?int            $darkThemeDimming = null,
    ) {
        $this->type = $type;
        $this->fill = $fill;
        $this->darkThemeDimming = $darkThemeDimming;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getFill(): ?BackgroundFill {
        return $this->fill;
    }

    public function setFill(?BackgroundFill $value): self {
        $this->fill = $value;
        return $this;
    }

    public function getDarkThemeDimming(): ?int {
        return $this->darkThemeDimming;
    }

    public function setDarkThemeDimming(?int $value): self {
        $this->darkThemeDimming = $value;
        return $this;
    }

}
