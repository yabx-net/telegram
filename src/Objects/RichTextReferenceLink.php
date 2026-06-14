<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichTextReferenceLink extends RichText {

    protected string $type = 'reference_link';

    protected mixed $text = null;

    protected ?string $referenceName = null;

    public function __construct(
        mixed $text = null,
        ?string $referenceName = null
    ) {
        $this->text = $text;
        $this->referenceName = $referenceName;
    }

    public static function fromArray(array $data): RichTextReferenceLink {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['reference_name'])) {
            $instance->referenceName = $data['reference_name'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getText(): mixed {
        return $this->text;
    }

    public function setText(mixed $value): self {
        $this->text = $value;
        return $this;
    }

    public function getReferenceName(): ?string {
        return $this->referenceName;
    }

    public function setReferenceName(?string $value): self {
        $this->referenceName = $value;
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
