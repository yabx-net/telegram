<?php

namespace Yabx\Telegram\Objects;

/**
 * A list of blocks, corresponding to the HTML tag <ul> or <ol> with multiple nested tags <li>.
 * @link https://core.telegram.org/bots/api#inputrichblocklist
 */
final class InputRichBlockList extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "list"
     * @var string
     */
    protected string $type = 'list';

    /**
     * Items
     *
     * Items of the list
     * @var InputRichBlockListItem[]|null
     */
    protected ?array $items = null;

    public function __construct(
        ?array $items = null
    ) {
        $this->items = $items;
    }

    public static function fromArray(array $data): InputRichBlockList {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['items'])) {
            $instance->items = InputRichBlockListItem::arrayOf($data['items']);
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
