<?php

namespace Yabx\Telegram\Objects;

final class RichMessage extends AbstractObject {

    protected ?array $blocks = null;

    protected ?bool $isRtl = null;

    public function __construct(
        ?array $blocks = null,
        ?bool $isRtl = null
    ) {
        $this->blocks = $blocks;
        $this->isRtl = $isRtl;
    }

    public static function fromArray(array $data): RichMessage {
        $instance = new self();
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => RichBlock::fromArray($item), $data['blocks']);
        }
        if (isset($data['is_rtl'])) {
            $instance->isRtl = $data['is_rtl'];
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

    public function getIsRtl(): ?bool {
        return $this->isRtl;
    }

    public function setIsRtl(?bool $value): self {
        $this->isRtl = $value;
        return $this;
    }
}
