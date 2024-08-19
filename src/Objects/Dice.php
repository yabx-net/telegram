<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Dice {

    use ObjectTrait;

    /**
     * Emoji
     *
     * Emoji on which the dice throw animation is based
     * @var string|null
     */
    protected ?string $emoji = null;

    /**
     * Value
     *
     * Value of the dice, 1-6 for “”, “” and “” base emoji, 1-5 for “” and “” base emoji, 1-64 for “” base emoji
     * @var int|null
     */
    protected ?int $value = null;

    public static function fromArray(array $data): Dice {
        $instance = new self();
        if (isset($data['emoji'])) {
            $instance->emoji = $data['emoji'];
        }
        if (isset($data['value'])) {
            $instance->value = $data['value'];
        }
        return $instance;
    }

    public function __construct(
        ?string $emoji = null,
        ?int    $value = null,
    ) {
        $this->emoji = $emoji;
        $this->value = $value;
    }

    public function getEmoji(): ?string {
        return $this->emoji;
    }

    public function setEmoji(?string $value): self {
        $this->emoji = $value;
        return $this;
    }

    public function getValue(): ?int {
        return $this->value;
    }

    public function setValue(?int $value): self {
        $this->value = $value;
        return $this;
    }

}
