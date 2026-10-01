<?php

namespace Yabx\Telegram\Objects;

/**
 * A button.
 * @link https://core.telegram.org/bots/api#richtextbutton
 */
final class RichTextButton extends RichText {

    /**
     * Type
     *
     * Type of the rich text, always "button"
     * @var string
     */
    protected string $type = 'button';

    /**
     * Button
     *
     * The button
     * @var RichMessageButton|null
     */
    protected ?RichMessageButton $button = null;

    public function __construct(
        ?RichMessageButton $button = null,
    ) {
        $this->button = $button;
    }

    public static function fromArray(array $data): RichTextButton {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['button'])) {
            $instance->button = RichMessageButton::fromArray($data['button']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getButton(): ?RichMessageButton {
        return $this->button;
    }

    public function setButton(?RichMessageButton $value): self {
        $this->button = $value;
        return $this;
    }
}
