<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

/**
 * A block quotation, corresponding to the HTML tag <blockquote>.
 * @link https://core.telegram.org/bots/api#inputrichblockblockquotation
 */
final class InputRichBlockBlockQuotation extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "blockquote"
     * @var string
     */
    protected string $type = 'blockquote';

    /**
     * Blocks
     *
     * Content of the block
     * @var InputRichBlock[]|null
     */
    protected ?array $blocks = null;

    /**
     * Credit
     *
     * Optional. Credit of the block
     * @var RichText|string|array|null
     */
    protected mixed $credit = null;

    public function __construct(
        ?array $blocks = null,
        mixed $credit = null
    ) {
        $this->blocks = $blocks;
        $this->credit = $credit;
    }

    public static function fromArray(array $data): InputRichBlockBlockQuotation {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => InputRichBlock::fromArray($item), $data['blocks']);
        }
        if (isset($data['credit'])) {
            $instance->credit = RichText::fromMixed($data['credit']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getBlocks(): ?array {
        return $this->blocks;
    }

    public function setBlocks(?array $value): self {
        $this->blocks = $value;
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
