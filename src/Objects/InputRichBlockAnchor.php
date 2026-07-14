<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with an anchor, corresponding to the HTML tag <a> with the attribute name.
 * @link https://core.telegram.org/bots/api#inputrichblockanchor
 */
final class InputRichBlockAnchor extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "anchor"
     * @var string
     */
    protected string $type = 'anchor';

    /**
     * Name
     *
     * The name of the anchor
     * @var string|null
     */
    protected ?string $name = null;

    public function __construct(
        ?string $name = null
    ) {
        $this->name = $name;
    }

    public static function fromArray(array $data): InputRichBlockAnchor {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }
}
