<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BotName {

    use ObjectTrait;

    /**
     * Name
     *
     * The bot's name
     * @var string|null
     */
    protected ?string $name = null;

    public function __construct(
        ?string $name = null,
    ) {
        $this->name = $name;
    }

    public static function fromArray(array $data): BotName {
        $instance = new self();
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        return $instance;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

}
