<?php

namespace Yabx\Telegram\Objects;

final class RichTextAnchor extends RichText {

    protected string $type = 'anchor';

    protected ?string $name = null;

    public function __construct(
        ?string $name = null
    ) {
        $this->name = $name;
    }

    public static function fromArray(array $data): RichTextAnchor {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }
}
