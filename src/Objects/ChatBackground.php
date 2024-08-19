<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatBackground {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the background
     * @var BackgroundType|null
     */
    protected ?BackgroundType $type = null;

    public static function fromArray(array $data): ChatBackground {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = BackgroundType::fromArray($data['type']);
        }
        return $instance;
    }

    public function __construct(
        ?BackgroundType $type = null,
    ) {
        $this->type = $type;
    }

    public function getType(): ?BackgroundType {
        return $this->type;
    }

    public function setType(?BackgroundType $value): self {
        $this->type = $value;
        return $this;
    }

}
