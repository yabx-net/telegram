<?php

namespace Yabx\Telegram\Objects;

final class InlineKeyboardMarkup extends AbstractObject {

    /**
     * Inline Keyboard
     *
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     * @var InlineKeyboardButton[]|null
     */
    protected ?array $inlineKeyboard = null;

    public function __construct(
        ?array $inlineKeyboard = null,
    ) {
        $this->inlineKeyboard = $inlineKeyboard;
    }

    public static function fromArray(array $data): InlineKeyboardMarkup {
        $instance = new self();
        if (isset($data['inline_keyboard'])) {
            $instance->inlineKeyboard = array_map(
                fn(array $row) => InlineKeyboardButton::arrayOf($row),
                $data['inline_keyboard'],
            );
        }
        return $instance;
    }

    public function getInlineKeyboard(): ?array {
        return $this->inlineKeyboard;
    }

    public function setInlineKeyboard(?array $value): self {
        $this->inlineKeyboard = $value;
        return $this;
    }

}
