<?php

namespace Yabx\Telegram\Objects;

/**
 * A collage, corresponding to the custom HTML tag <tg-collage>.
 * @link https://core.telegram.org/bots/api#inputrichblockcollage
 */
final class InputRichBlockCollage extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "collage"
     * @var string
     */
    protected string $type = 'collage';

    /**
     * Blocks
     *
     * Elements of the collage
     * @var InputRichBlock[]|null
     */
    protected ?array $blocks = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?array $blocks = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->blocks = $blocks;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): InputRichBlockCollage {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => InputRichBlock::fromArray($item), $data['blocks']);
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
