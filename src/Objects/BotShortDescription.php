<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BotShortDescription {

    use ObjectTrait;

    /**
     * Short Description
     *
     * The bot's short description
     * @var string|null
     */
    protected ?string $shortDescription = null;

    public static function fromArray(array $data): BotShortDescription {
        $instance = new self();
        if (isset($data['short_description'])) {
            $instance->shortDescription = $data['short_description'];
        }
        return $instance;
    }

    public function __construct(
        ?string $shortDescription = null,
    ) {
        $this->shortDescription = $shortDescription;
    }

    public function getShortDescription(): ?string {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $value): self {
        $this->shortDescription = $value;
        return $this;
    }

}
