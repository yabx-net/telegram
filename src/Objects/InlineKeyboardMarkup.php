<?php

namespace Yabx\Telegram\Objects;

class InlineKeyboardMarkup {

    /**
     * Inline Keyboard
     *
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     * @var InlineKeyboardButton[]
     */
    protected array $inlineKeyboard;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['inline_keyboard'])) {
            $this->inlineKeyboard = [];
            foreach ($data['inline_keyboard'] as $item) {
                $this->inlineKeyboard[] = new InlineKeyboardButton($item);
            }
        }
    }

    public function getInlineKeyboard(): array {
        return $this->inlineKeyboard;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
