<?php

namespace Yabx\Telegram\Objects;

final class RevenueWithdrawalStateFailed extends RevenueWithdrawalState {

    /**
     * Type
     *
     * Type of the state, always “failed”
     * @var string
     */
    protected string $type = 'failed';

    public static function fromArray(array $data): RevenueWithdrawalStateFailed {
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
