<?php

namespace Yabx\Telegram\Objects;

final class RichBlockCollage extends RichBlock {

    protected string $type = 'collage';

    protected ?array $blocks = null;

    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?array $blocks = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->blocks = $blocks;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockCollage {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => RichBlock::fromArray($item), $data['blocks']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
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

    public function getCaption(): ?RichBlockCaption {
        return $this->caption;
    }

    public function setCaption(?RichBlockCaption $value): self {
        $this->caption = $value;
        return $this;
    }
}
