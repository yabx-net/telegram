<?php

namespace Yabx\Telegram\Objects;

final class BackgroundTypeFill extends BackgroundType {

    /**
     * Type
     *
     * Type of the background, always “fill”
     * @var string
     */
    protected string $type = 'fill';

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

    public function __construct(
        ?BackgroundFill $fill = null,
        ?int            $darkThemeDimming = null,
    ) {
        $this->fill = $fill;
        $this->darkThemeDimming = $darkThemeDimming;
    }

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

    public function getType(): string {
        return $this->type;
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
