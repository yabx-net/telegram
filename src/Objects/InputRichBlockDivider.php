<?php

namespace Yabx\Telegram\Objects;

/**
 * A divider, corresponding to the HTML tag <hr/>.
 * @link https://core.telegram.org/bots/api#inputrichblockdivider
 */
final class InputRichBlockDivider extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "divider"
     * @var string
     */
    protected string $type = 'divider';

    public function __construct(
        
    ) {
    }

    public static function fromArray(array $data): InputRichBlockDivider {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }
}
