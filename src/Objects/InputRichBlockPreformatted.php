<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

/**
 * A preformatted text block, corresponding to the nested HTML tags <pre> and <code>.
 * @link https://core.telegram.org/bots/api#inputrichblockpreformatted
 */
final class InputRichBlockPreformatted extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "pre"
     * @var string
     */
    protected string $type = 'pre';

    /**
     * Text
     *
     * Text of the block
     * @var RichText|string|array|null
     */
    protected mixed $text = null;

    /**
     * Language
     *
     * Optional. The programming language of the text
     * @var string|null
     */
    protected ?string $language = null;

    public function __construct(
        mixed $text = null,
        ?string $language = null
    ) {
        $this->text = $text;
        $this->language = $language;
    }

    public static function fromArray(array $data): InputRichBlockPreformatted {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['language'])) {
            $instance->language = $data['language'];
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

    public function getLanguage(): ?string {
        return $this->language;
    }

    public function setLanguage(?string $value): self {
        $this->language = $value;
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
