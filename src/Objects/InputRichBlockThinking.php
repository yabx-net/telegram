<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

/**
 * A block with a "Thinking..." placeholder, corresponding to the custom HTML tag <tg-thinking>. The block may be used only in sendRichMessageDraft, therefore it can't be received in messages.
 * @link https://core.telegram.org/bots/api#inputrichblockthinking
 */
final class InputRichBlockThinking extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "thinking"
     * @var string
     */
    protected string $type = 'thinking';

    /**
     * Text
     *
     * Text of the block. See https://t.me/addemoji/AIActions for examples of custom emoji that are recommended for usage in the block.
     * @var RichText|string|array|null
     */
    protected mixed $text = null;

    public function __construct(
        mixed $text = null
    ) {
        $this->text = $text;
    }

    public static function fromArray(array $data): InputRichBlockThinking {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
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
