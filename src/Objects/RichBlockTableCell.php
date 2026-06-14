<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichBlockTableCell extends AbstractObject {

    protected mixed $text = null;

    protected ?bool $isHeader = null;

    protected ?int $colspan = null;

    protected ?int $rowspan = null;

    protected ?string $align = null;

    protected ?string $valign = null;

    public function __construct(
        mixed $text = null,
        ?bool $isHeader = null,
        ?int $colspan = null,
        ?int $rowspan = null,
        ?string $align = null,
        ?string $valign = null
    ) {
        $this->text = $text;
        $this->isHeader = $isHeader;
        $this->colspan = $colspan;
        $this->rowspan = $rowspan;
        $this->align = $align;
        $this->valign = $valign;
    }

    public static function fromArray(array $data): RichBlockTableCell {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['is_header'])) {
            $instance->isHeader = $data['is_header'];
        }
        if (isset($data['colspan'])) {
            $instance->colspan = $data['colspan'];
        }
        if (isset($data['rowspan'])) {
            $instance->rowspan = $data['rowspan'];
        }
        if (isset($data['align'])) {
            $instance->align = $data['align'];
        }
        if (isset($data['valign'])) {
            $instance->valign = $data['valign'];
        }
        return $instance;
    }

    public function getText(): mixed {
        return $this->text;
    }

    public function setText(mixed $value): self {
        $this->text = $value;
        return $this;
    }

    public function getIsHeader(): ?bool {
        return $this->isHeader;
    }

    public function setIsHeader(?bool $value): self {
        $this->isHeader = $value;
        return $this;
    }

    public function getColspan(): ?int {
        return $this->colspan;
    }

    public function setColspan(?int $value): self {
        $this->colspan = $value;
        return $this;
    }

    public function getRowspan(): ?int {
        return $this->rowspan;
    }

    public function setRowspan(?int $value): self {
        $this->rowspan = $value;
        return $this;
    }

    public function getAlign(): ?string {
        return $this->align;
    }

    public function setAlign(?string $value): self {
        $this->align = $value;
        return $this;
    }

    public function getValign(): ?string {
        return $this->valign;
    }

    public function setValign(?string $value): self {
        $this->valign = $value;
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
