<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichTextPhoneNumber extends RichText {

    protected string $type = 'phone_number';

    protected mixed $text = null;

    protected ?string $phoneNumber = null;

    public function __construct(
        mixed $text = null,
        ?string $phoneNumber = null
    ) {
        $this->text = $text;
        $this->phoneNumber = $phoneNumber;
    }

    public static function fromArray(array $data): RichTextPhoneNumber {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['phone_number'])) {
            $instance->phoneNumber = $data['phone_number'];
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

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $value): self {
        $this->phoneNumber = $value;
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
