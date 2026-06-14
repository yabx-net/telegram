<?php

namespace Yabx\Telegram\Objects;

final class RichBlockDivider extends RichBlock {

    protected string $type = 'divider';

    public function __construct(
        
    ) {
    }

    public static function fromArray(array $data): RichBlockDivider {
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
