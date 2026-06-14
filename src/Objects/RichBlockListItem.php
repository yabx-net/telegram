<?php

namespace Yabx\Telegram\Objects;

final class RichBlockListItem extends AbstractObject {

    protected ?string $label = null;

    protected ?array $blocks = null;

    protected ?bool $hasCheckbox = null;

    protected ?bool $isChecked = null;

    protected ?int $value = null;

    protected ?string $type = null;

    public function __construct(
        ?string $label = null,
        ?array $blocks = null,
        ?bool $hasCheckbox = null,
        ?bool $isChecked = null,
        ?int $value = null,
        ?string $type = null
    ) {
        $this->label = $label;
        $this->blocks = $blocks;
        $this->hasCheckbox = $hasCheckbox;
        $this->isChecked = $isChecked;
        $this->value = $value;
        $this->type = $type;
    }

    public static function fromArray(array $data): RichBlockListItem {
        $instance = new self();
        if (isset($data['label'])) {
            $instance->label = $data['label'];
        }
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => RichBlock::fromArray($item), $data['blocks']);
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

    public function getLabel(): ?string {
        return $this->label;
    }

    public function setLabel(?string $value): self {
        $this->label = $value;
        return $this;
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
