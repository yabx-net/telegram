<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

final class RichTextDateTime extends RichText {

    protected string $type = 'date_time';

    protected mixed $text = null;

    protected ?int $unixTime = null;

    protected ?string $dateTimeFormat = null;

    public function __construct(
        mixed $text = null,
        ?int $unixTime = null,
        ?string $dateTimeFormat = null
    ) {
        $this->text = $text;
        $this->unixTime = $unixTime;
        $this->dateTimeFormat = $dateTimeFormat;
    }

    public static function fromArray(array $data): RichTextDateTime {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['unix_time'])) {
            $instance->unixTime = $data['unix_time'];
        }
        if (isset($data['date_time_format'])) {
            $instance->dateTimeFormat = $data['date_time_format'];
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

    public function getUnixTime(): ?int {
        return $this->unixTime;
    }

    public function setUnixTime(?int $value): self {
        $this->unixTime = $value;
        return $this;
    }

    public function getDateTimeFormat(): ?string {
        return $this->dateTimeFormat;
    }

    public function setDateTimeFormat(?string $value): self {
        $this->dateTimeFormat = $value;
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
