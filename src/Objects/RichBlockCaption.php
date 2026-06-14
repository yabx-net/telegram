<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichBlockCaption extends AbstractObject {

    protected mixed $text = null;

    protected mixed $credit = null;

    public function __construct(
        mixed $text = null,
        mixed $credit = null
    ) {
        $this->text = $text;
        $this->credit = $credit;
    }

    public static function fromArray(array $data): RichBlockCaption {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['credit'])) {
            $instance->credit = RichText::fromMixed($data['credit']);
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

    public function getCredit(): mixed {
        return $this->credit;
    }

    public function setCredit(mixed $value): self {
        $this->credit = $value;
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
