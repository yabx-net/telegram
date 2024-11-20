<?php

namespace Yabx\Telegram\Objects;

final class RevenueWithdrawalStatePending extends RevenueWithdrawalState {

    /**
     * Type
     *
     * Type of the state, always “pending”
     * @var string
     */
    protected string $type = 'pending';

    public static function fromArray(array $data): RevenueWithdrawalStatePending {
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
