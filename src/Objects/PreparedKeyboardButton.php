<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a keyboard button to be used by a user of a Mini App.
 * @link https://core.telegram.org/bots/api#preparedkeyboardbutton
 */
final class PreparedKeyboardButton extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier of the keyboard button
     * @var string|null
     */
    protected ?string $id = null;

    public static function fromArray(array $data): PreparedKeyboardButton {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        return $instance;
    }

    public function __construct(
        ?string $id = null,
    ) {
        $this->id = $id;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

}
