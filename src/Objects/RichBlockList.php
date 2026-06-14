<?php

namespace Yabx\Telegram\Objects;

final class RichBlockList extends RichBlock {

    protected string $type = 'list';

    protected ?array $items = null;

    public function __construct(
        ?array $items = null
    ) {
        $this->items = $items;
    }

    public static function fromArray(array $data): RichBlockList {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['items'])) {
            $instance->items = RichBlockListItem::arrayOf($data['items']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getItems(): ?array {
        return $this->items;
    }

    public function setItems(?array $value): self {
        $this->items = $value;
        return $this;
    }
}
