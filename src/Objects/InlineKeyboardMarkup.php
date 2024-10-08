<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InlineKeyboardMarkup {

    use ObjectTrait;

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
            $instance->inlineKeyboard = [];
            foreach ($data['inline_keyboard'] as $item) {
                $instance->inlineKeyboard[] = InlineKeyboardButton::fromArray($item);
            }
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
