<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ReplyKeyboardMarkup extends ReplyMarkup {

    use ObjectTrait;

    /**
     * Keyboard
     *
     * Array of button rows, each represented by an Array of KeyboardButton objects
     * @var KeyboardButton[]|null
     */
    protected ?array $keyboard = null;

    /**
     * Is Persistent
     *
     * Optional. Requests clients to always show the keyboard when the regular keyboard is hidden. Defaults to false, in which case the custom keyboard can be hidden and opened with a keyboard icon.
     * @var bool|null
     */
    protected ?bool $isPersistent = null;

    /**
     * Resize Keyboard
     *
     * Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     * @var bool|null
     */
    protected ?bool $resizeKeyboard = null;

    /**
     * One Time Keyboard
     *
     * Optional. Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat - the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
     * @var bool|null
     */
    protected ?bool $oneTimeKeyboard = null;

    /**
     * Input Field Placeholder
     *
     * Optional. The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
     * @var string|null
     */
    protected ?string $inputFieldPlaceholder = null;

    /**
     * Selective
     *
     * Optional. Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message.Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
     * @var bool|null
     */
    protected ?bool $selective = null;

    public function __construct(
        ?array  $keyboard = null,
        ?bool   $isPersistent = null,
        ?bool   $resizeKeyboard = null,
        ?bool   $oneTimeKeyboard = null,
        ?string $inputFieldPlaceholder = null,
        ?bool   $selective = null,
    ) {
        $this->keyboard = $keyboard;
        $this->isPersistent = $isPersistent;
        $this->resizeKeyboard = $resizeKeyboard;
        $this->oneTimeKeyboard = $oneTimeKeyboard;
        $this->inputFieldPlaceholder = $inputFieldPlaceholder;
        $this->selective = $selective;
    }

    public static function fromArray(array $data): ReplyKeyboardMarkup {
        $instance = new self();
        if (isset($data['keyboard'])) {
            $instance->keyboard = [];
            foreach ($data['keyboard'] as $item) {
                $instance->keyboard[] = KeyboardButton::fromArray($item);
            }
        }
        if (isset($data['is_persistent'])) {
            $instance->isPersistent = $data['is_persistent'];
        }
        if (isset($data['resize_keyboard'])) {
            $instance->resizeKeyboard = $data['resize_keyboard'];
        }
        if (isset($data['one_time_keyboard'])) {
            $instance->oneTimeKeyboard = $data['one_time_keyboard'];
        }
        if (isset($data['input_field_placeholder'])) {
            $instance->inputFieldPlaceholder = $data['input_field_placeholder'];
        }
        if (isset($data['selective'])) {
            $instance->selective = $data['selective'];
        }
        return $instance;
    }

    public function getKeyboard(): ?array {
        return $this->keyboard;
    }

    public function setKeyboard(?array $value): self {
        $this->keyboard = $value;
        return $this;
    }

    public function getIsPersistent(): ?bool {
        return $this->isPersistent;
    }

    public function setIsPersistent(?bool $value): self {
        $this->isPersistent = $value;
        return $this;
    }

    public function getResizeKeyboard(): ?bool {
        return $this->resizeKeyboard;
    }

    public function setResizeKeyboard(?bool $value): self {
        $this->resizeKeyboard = $value;
        return $this;
    }

    public function getOneTimeKeyboard(): ?bool {
        return $this->oneTimeKeyboard;
    }

    public function setOneTimeKeyboard(?bool $value): self {
        $this->oneTimeKeyboard = $value;
        return $this;
    }

    public function getInputFieldPlaceholder(): ?string {
        return $this->inputFieldPlaceholder;
    }

    public function setInputFieldPlaceholder(?string $value): self {
        $this->inputFieldPlaceholder = $value;
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
