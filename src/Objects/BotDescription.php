<?php

namespace Yabx\Telegram\Objects;

final class BotDescription extends AbstractObject {

    /**
     * Description
     *
     * The bot's description
     * @var string|null
     */
    protected ?string $description = null;

    public function __construct(
        ?string $description = null,
    ) {
        $this->description = $description;
    }

    public static function fromArray(array $data): BotDescription {
        $instance = new self();
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        return $instance;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
        return $this;
    }

}
