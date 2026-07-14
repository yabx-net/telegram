<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

/**
 * A section heading, corresponding to the HTML tags <h1>, <h2>, <h3>, <h4>, <h5>, or <h6>.
 * @link https://core.telegram.org/bots/api#inputrichblocksectionheading
 */
final class InputRichBlockSectionHeading extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "heading"
     * @var string
     */
    protected string $type = 'heading';

    /**
     * Text
     *
     * Text of the block
     * @var RichText|string|array|null
     */
    protected mixed $text = null;

    /**
     * Size
     *
     * Relative size of the text font; 1-6, 1 is the largest, 6 is the smallest
     * @var int|null
     */
    protected ?int $size = null;

    public function __construct(
        mixed $text = null,
        ?int $size = null
    ) {
        $this->text = $text;
        $this->size = $size;
    }

    public static function fromArray(array $data): InputRichBlockSectionHeading {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['size'])) {
            $instance->size = $data['size'];
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

    public function getSize(): ?int {
        return $this->size;
    }

    public function setSize(?int $value): self {
        $this->size = $value;
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
