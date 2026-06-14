<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichBlockDetails extends RichBlock {

    protected string $type = 'details';

    protected mixed $summary = null;

    protected ?array $blocks = null;

    protected ?bool $isOpen = null;

    public function __construct(
        mixed $summary = null,
        ?array $blocks = null,
        ?bool $isOpen = null
    ) {
        $this->summary = $summary;
        $this->blocks = $blocks;
        $this->isOpen = $isOpen;
    }

    public static function fromArray(array $data): RichBlockDetails {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['summary'])) {
            $instance->summary = RichText::fromMixed($data['summary']);
        }
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => RichBlock::fromArray($item), $data['blocks']);
        }
        if (isset($data['is_open'])) {
            $instance->isOpen = $data['is_open'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getSummary(): mixed {
        return $this->summary;
    }

    public function setSummary(mixed $value): self {
        $this->summary = $value;
        return $this;
    }

    public function getBlocks(): ?array {
        return $this->blocks;
    }

    public function setBlocks(?array $value): self {
        $this->blocks = $value;
        return $this;
    }

    public function getIsOpen(): ?bool {
        return $this->isOpen;
    }

    public function setIsOpen(?bool $value): self {
        $this->isOpen = $value;
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
