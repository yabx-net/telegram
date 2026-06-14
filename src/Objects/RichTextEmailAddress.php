<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichTextEmailAddress extends RichText {

    protected string $type = 'email_address';

    protected mixed $text = null;

    protected ?string $emailAddress = null;

    public function __construct(
        mixed $text = null,
        ?string $emailAddress = null
    ) {
        $this->text = $text;
        $this->emailAddress = $emailAddress;
    }

    public static function fromArray(array $data): RichTextEmailAddress {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['email_address'])) {
            $instance->emailAddress = $data['email_address'];
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

    public function getEmailAddress(): ?string {
        return $this->emailAddress;
    }

    public function setEmailAddress(?string $value): self {
        $this->emailAddress = $value;
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
