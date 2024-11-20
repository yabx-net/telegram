<?php

namespace Yabx\Telegram\Objects;

final class BackgroundFillFreeformGradient extends BackgroundFill {

    /**
     * Type
     *
     * Type of the background fill, always “freeform_gradient”
     * @var string
     */
    protected string $type = 'freeform_gradient';

    /**
     * Colors
     *
     * A list of the 3 or 4 base colors that are used to generate the freeform gradient in the RGB24 format
     * @var int[]|null
     */
    protected ?array $colors = null;

    public function __construct(
        ?array $colors = null,
    ) {
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

    public function getType(): string {
        return $this->type;
    }

    public function getColors(): ?array {
        return $this->colors;
    }

    public function setColors(?array $value): self {
        $this->colors = $value;
        return $this;
    }

}
