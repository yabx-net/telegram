<?php

namespace Yabx\Telegram\Objects;

final class BackgroundFillSolid extends AbstractObject {

    /**
     * Type
     *
     * Type of the background fill, always “solid”
     * @var string
     */
    protected string $type = 'solid';

    /**
     * Color
     *
     * The color of the background fill in the RGB24 format
     * @var int|null
     */
    protected ?int $color = null;

    public function __construct(
        ?int    $color = null,
    ) {
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

    public function getType(): string {
        return $this->type;
    }

    public function getColor(): ?int {
        return $this->color;
    }

    public function setColor(?int $value): self {
        $this->color = $value;
        return $this;
    }

}
