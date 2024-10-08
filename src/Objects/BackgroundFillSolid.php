<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BackgroundFillSolid {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the background fill, always “solid”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Color
     *
     * The color of the background fill in the RGB24 format
     * @var int|null
     */
    protected ?int $color = null;

    public function __construct(
        ?string $type = null,
        ?int    $color = null,
    ) {
        $this->type = $type;
        $this->color = $color;
    }

    public static function fromArray(array $data): BackgroundFillSolid {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['color'])) {
            $instance->color = $data['color'];
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

    public function getColor(): ?int {
        return $this->color;
    }

    public function setColor(?int $value): self {
        $this->color = $value;
        return $this;
    }

}
