<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ReplyKeyboardRemove extends ReplyMarkup {

    use ObjectTrait;

    /**
     * Remove Keyboard
     *
     * Requests clients to remove the custom keyboard (user will not be able to summon this keyboard; if you want to hide the keyboard from sight but keep it accessible, use one_time_keyboard in ReplyKeyboardMarkup)
     * @var bool|null
     */
    protected ?bool $removeKeyboard = null;

    /**
     * Selective
     *
     * Optional. Use this parameter if you want to remove the keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message.Example: A user votes in a poll, bot returns confirmation message in reply to the vote and removes the keyboard for that user, while still showing the keyboard with poll options to users who haven't voted yet.
     * @var bool|null
     */
    protected ?bool $selective = null;

    public function __construct(
        ?bool $removeKeyboard = null,
        ?bool $selective = null,
    ) {
        $this->removeKeyboard = $removeKeyboard;
        $this->selective = $selective;
    }

    public static function fromArray(array $data): ReplyKeyboardRemove {
        $instance = new self();
        if (isset($data['remove_keyboard'])) {
            $instance->removeKeyboard = $data['remove_keyboard'];
        }
        if (isset($data['selective'])) {
            $instance->selective = $data['selective'];
        }
        return $instance;
    }

    public function getRemoveKeyboard(): ?bool {
        return $this->removeKeyboard;
    }

    public function setRemoveKeyboard(?bool $value): self {
        $this->removeKeyboard = $value;
        return $this;
    }

    public function getSelective(): ?bool {
        return $this->selective;
    }

    public function setSelective(?bool $value): self {
        $this->selective = $value;
        return $this;
    }

}
