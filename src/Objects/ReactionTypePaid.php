<?php

namespace Yabx\Telegram\Objects;

final class ReactionTypePaid extends ReactionType {

    /**
     * Type
     *
     * Type of the reaction, always “paid”
     * @var string
     */
    protected string $type = 'paid';

    public static function fromArray(array $data): ReactionTypePaid {
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
