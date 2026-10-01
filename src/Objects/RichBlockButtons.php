<?php

namespace Yabx\Telegram\Objects;

/**
 * A block containing a list of buttons that are shown in one row, corresponding to the custom HTML tag <tg-button-row>.
 * @link https://core.telegram.org/bots/api#richblockbuttons
 */
final class RichBlockButtons extends RichBlock {

    /**
     * Type
     *
     * Type of the block, always "buttons"
     * @var string
     */
    protected string $type = 'buttons';

    /**
     * Buttons
     *
     * The buttons
     * @var RichMessageButton[]|null
     */
    protected ?array $buttons = null;

    /**
     * Align
     *
     * Optional. Horizontal alignment of the buttons. Currently, must be one of "left", "center", or "right".
     * @var string|null
     */
    protected ?string $align = null;

    public function __construct(
        ?array $buttons = null,
        ?string $align = null,
    ) {
        $this->buttons = $buttons;
        $this->align = $align;
    }

    public static function fromArray(array $data): RichBlockButtons {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['buttons'])) {
            $instance->buttons = RichMessageButton::arrayOf($data['buttons']);
        }
        if (isset($data['align'])) {
            $instance->align = $data['align'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getButtons(): ?array {
        return $this->buttons;
    }

    public function setButtons(?array $value): self {
        $this->buttons = $value;
        return $this;
    }

    public function getAlign(): ?string {
        return $this->align;
    }

    public function setAlign(?string $value): self {
        $this->align = $value;
        return $this;
    }
}
