<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BackgroundFillFreeformGradient extends BackgroundFill {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the background fill, always “freeform_gradient”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Colors
     *
     * A list of the 3 or 4 base colors that are used to generate the freeform gradient in the RGB24 format
     * @var int[]|null
     */
    protected ?array $colors = null;

    public function __construct(
        ?string $type = null,
        ?array  $colors = null,
    ) {
        $this->type = $type;
        $this->colors = $colors;
    }

    public static function fromArray(array $data): BackgroundFillFreeformGradient {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['colors'])) {
            $instance->colors = [];
            foreach ($data['colors'] as $item) {
                $instance->colors[] = $item;
            }
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

    public function getColors(): ?array {
        return $this->colors;
    }

    public function setColors(?array $value): self {
        $this->colors = $value;
        return $this;
    }

}