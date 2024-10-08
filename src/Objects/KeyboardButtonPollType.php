<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class KeyboardButtonPollType {

    use ObjectTrait;

    /**
     * Type
     *
     * Optional. If quiz is passed, the user will be allowed to create only polls in the quiz mode. If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create a poll of any type.
     * @var string|null
     */
    protected ?string $type = null;

    public static function fromArray(array $data): KeyboardButtonPollType {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
    ) {
        $this->type = $type;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

}
