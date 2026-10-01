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

    /**
     * Force Reply
     *
     * Optional. Pass True if the reply interface must be shown to the user, as if they had manually selected the bot's message and tapped 'Reply'. The value of the field can't be changed when the inline keyboard is edited.
     * @var bool|null
     */
    protected ?bool $forceReply = null;

    public function __construct(
        ?array $inlineKeyboard = null,
        ?bool $forceReply = null,
    ) {
        $this->inlineKeyboard = $inlineKeyboard;
        $this->forceReply = $forceReply;
    }

    public static function fromArray(array $data): InlineKeyboardMarkup {
        $instance = new self();
        if (isset($data['inline_keyboard'])) {
            $instance->inlineKeyboard = array_map(
                fn(array $row) => InlineKeyboardButton::arrayOf($row),
                $data['inline_keyboard'],
            );
        }
        if (isset($data['force_reply'])) {
            $instance->forceReply = $data['force_reply'];
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

    public function getForceReply(): ?bool {
        return $this->forceReply;
    }

    public function setForceReply(?bool $value): self {
        $this->forceReply = $value;
        return $this;
    }

}
