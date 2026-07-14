<?php

namespace Yabx\Telegram\Objects;

/**
 * An item of a list to be sent.
 * @link https://core.telegram.org/bots/api#inputrichblocklistitem
 */
final class InputRichBlockListItem extends AbstractObject {

    /**
     * Blocks
     *
     * The content of the item
     * @var InputRichBlock[]|null
     */
    protected ?array $blocks = null;

    /**
     * Has Checkbox
     *
     * Optional. Pass True if the item has a checkbox
     * @var bool|null
     */
    protected ?bool $hasCheckbox = null;

    /**
     * Is Checked
     *
     * Optional. Pass True if the item has a checked checkbox
     * @var bool|null
     */
    protected ?bool $isChecked = null;

    /**
     * Value
     *
     * Optional. For ordered lists, the numeric value of the item label
     * @var int|null
     */
    protected ?int $value = null;

    /**
     * Type
     *
     * Optional. For ordered lists, the type of the item label; must be one of "a" for lowercase letters, "A" for uppercase letters, "i" for lowercase Roman numerals, "I" for uppercase Roman numerals, or "1" for decimal numbers
     * @var string|null
     */
    protected ?string $type = null;

    public function __construct(
        ?array $blocks = null,
        ?bool $hasCheckbox = null,
        ?bool $isChecked = null,
        ?int $value = null,
        ?string $type = null
    ) {
        $this->blocks = $blocks;
        $this->hasCheckbox = $hasCheckbox;
        $this->isChecked = $isChecked;
        $this->value = $value;
        $this->type = $type;
    }

    public static function fromArray(array $data): InputRichBlockListItem {
        $instance = new self();
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => InputRichBlock::fromArray($item), $data['blocks']);
        }
        if (isset($data['has_checkbox'])) {
            $instance->hasCheckbox = $data['has_checkbox'];
        }
        if (isset($data['is_checked'])) {
            $instance->isChecked = $data['is_checked'];
        }
        if (isset($data['value'])) {
            $instance->value = $data['value'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        return $instance;
    }

    public function getBlocks(): ?array {
        return $this->blocks;
    }

    public function setBlocks(?array $value): self {
        $this->blocks = $value;
        return $this;
    }

    public function getHasCheckbox(): ?bool {
        return $this->hasCheckbox;
    }

    public function setHasCheckbox(?bool $value): self {
        $this->hasCheckbox = $value;
        return $this;
    }

    public function getIsChecked(): ?bool {
        return $this->isChecked;
    }

    public function setIsChecked(?bool $value): self {
        $this->isChecked = $value;
        return $this;
    }

    public function getValue(): ?int {
        return $this->value;
    }

    public function setValue(?int $value): self {
        $this->value = $value;
        return $this;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }
}
