<?php

namespace Yabx\Telegram\Objects;

class Dice {

    /**
     * Emoji
     *
     * Emoji on which the dice throw animation is based
     * @var string
     */
    protected string $emoji;

    /**
     * Value
     *
     * Value of the dice, 1-6 for “”, “” and “” base emoji, 1-5 for “” and “” base emoji, 1-64 for “” base emoji
     * @var int
     */
    protected int $value;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['emoji'])) {
            $this->emoji = $data['emoji'];
        }
        if (isset($data['value'])) {
            $this->value = $data['value'];
        }
    }

    public function getEmoji(): string {
        return $this->emoji;
    }

    public function getValue(): int {
        return $this->value;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
