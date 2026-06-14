<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichBlockTable extends RichBlock {

    protected string $type = 'table';

    protected ?array $cells = null;

    protected ?bool $isBordered = null;

    protected ?bool $isStriped = null;

    protected mixed $caption = null;

    public function __construct(
        ?array $cells = null,
        ?bool $isBordered = null,
        ?bool $isStriped = null,
        mixed $caption = null
    ) {
        $this->cells = $cells;
        $this->isBordered = $isBordered;
        $this->isStriped = $isStriped;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockTable {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['cells'])) {
            $instance->cells = array_map(fn(array $row) => RichBlockTableCell::arrayOf($row), $data['cells']);
        }
        if (isset($data['is_bordered'])) {
            $instance->isBordered = $data['is_bordered'];
        }
        if (isset($data['is_striped'])) {
            $instance->isStriped = $data['is_striped'];
        }
        if (isset($data['caption'])) {
            $instance->caption = RichText::fromMixed($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getCells(): ?array {
        return $this->cells;
    }

    public function setCells(?array $value): self {
        $this->cells = $value;
        return $this;
    }

    public function getIsBordered(): ?bool {
        return $this->isBordered;
    }

    public function setIsBordered(?bool $value): self {
        $this->isBordered = $value;
        return $this;
    }

    public function getIsStriped(): ?bool {
        return $this->isStriped;
    }

    public function setIsStriped(?bool $value): self {
        $this->isStriped = $value;
        return $this;
    }

    public function getCaption(): mixed {
        return $this->caption;
    }

    public function setCaption(mixed $value): self {
        $this->caption = $value;
        return $this;
    }

    public function toArray(): array {
        $result = [];
        foreach (array_keys(get_object_vars($this)) as $key) {
            $value = $this->$key ?? null;
            if ($value === null) {
                continue;
            }
            if (in_array($key, ['text', 'credit', 'summary', 'caption'], true)) {
                $result[Utils::toSnakeCase($key)] = RichText::toMixed($value);
                continue;
            }
            if (is_array($value)) {
                array_walk_recursive($value, function (&$item) {
                    if (is_object($item) && method_exists($item, 'toArray')) {
                        $item = $item->toArray();
                    }
                });
            } elseif (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            $result[Utils::toSnakeCase($key)] = $value;
        }
        return $result;
    }
}
