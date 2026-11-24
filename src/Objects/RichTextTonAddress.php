<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

/**
 * An address in the TON blockchain.
 * @link https://core.telegram.org/bots/api#richtexttonaddress
 */
final class RichTextTonAddress extends RichText {

    /**
     * Type
     *
     * Type of the object, always "ton_address"
     * @var string
     */
    protected string $type = 'ton_address';

    /**
     * Text
     *
     * Text of the address
     * @var RichText|string|array|null
     */
    protected mixed $text = null;

    /**
     * Address
     *
     * The address
     * @var string|null
     */
    protected ?string $address = null;

    public function __construct(
        mixed $text = null,
        ?string $address = null
    ) {
        $this->text = $text;
        $this->address = $address;
    }

    public static function fromArray(array $data): RichTextTonAddress {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['address'])) {
            $instance->address = $data['address'];
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

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $value): self {
        $this->address = $value;
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
                $result[\Yabx\Telegram\Utils::toSnakeCase($key)] = \Yabx\Telegram\Objects\RichText::toMixed($value);
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
            $result[\Yabx\Telegram\Utils::toSnakeCase($key)] = $value;
        }
        return $result;
    }
}
