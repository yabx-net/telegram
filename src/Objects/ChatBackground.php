<?php

namespace Yabx\Telegram\Objects;

final class ChatBackground extends AbstractObject {

    /**
     * Type
     *
     * Type of the background
     * @var BackgroundType|null
     */
    protected ?BackgroundType $type = null;

    public function __construct(
        ?BackgroundType $type = null,
    ) {
        $this->type = $type;
    }

    public static function fromArray(array $data): ChatBackground {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = BackgroundType::fromArray($data['type']);
        }
        return $instance;
    }

    public function getType(): ?BackgroundType {
        return $this->type;
    }

    public function setType(?BackgroundType $value): self {
        $this->type = $value;
        return $this;
    }

}
