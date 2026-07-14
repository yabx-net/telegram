<?php

namespace Yabx\Telegram\Objects;

/**
 * A slideshow, corresponding to the custom HTML tag <tg-slideshow>.
 * @link https://core.telegram.org/bots/api#inputrichblockslideshow
 */
final class InputRichBlockSlideshow extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "slideshow"
     * @var string
     */
    protected string $type = 'slideshow';

    /**
     * Blocks
     *
     * Elements of the slideshow
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

    public static function fromArray(array $data): InputRichBlockSlideshow {
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
