<?php

namespace Yabx\Telegram\Objects;

class ReplyKeyboardRemove {

    /**
     * Remove Keyboard
     *
     * Requests clients to remove the custom keyboard (user will not be able to summon this keyboard; if you want to hide the keyboard from sight but keep it accessible, use one_time_keyboard in ReplyKeyboardMarkup)
     * @var bool
     */
    protected bool $removeKeyboard;

    /**
     * Selective
     *
     * Optional. Use this parameter if you want to remove the keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.Example: A user votes in a poll, bot returns confirmation message in reply to the vote and removes the keyboard for that user, while still showing the keyboard with poll options to users who haven't voted yet.
     * @var bool|null
     */
    protected ?bool $selective = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['remove_keyboard'])) {
            $this->removeKeyboard = $data['remove_keyboard'];
        }
        if (isset($data['selective'])) {
            $this->selective = $data['selective'];
        }
    }

    public function getRemoveKeyboard(): bool {
        return $this->removeKeyboard;
    }

    public function getSelective(): ?bool {
        return $this->selective;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
