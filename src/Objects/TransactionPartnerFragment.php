<?php

namespace Yabx\Telegram\Objects;

final class TransactionPartnerFragment extends TransactionPartner {

    /**
     * Type
     *
     * Type of the transaction partner, always “fragment”
     * @var string
     */
    protected string $type = 'fragment';

    /**
     * Withdrawal State
     *
     * Optional. State of the transaction if the transaction is outgoing
     * @var RevenueWithdrawalState|null
     */
    protected ?RevenueWithdrawalState $withdrawalState = null;

    public static function fromArray(array $data): TransactionPartnerFragment {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['withdrawal_state'])) {
            $instance->withdrawalState = RevenueWithdrawalState::fromArray($data['withdrawal_state']);
        }
        return $instance;
    }

    public function __construct(
        ?RevenueWithdrawalState $withdrawalState = null,
    ) {
        $this->withdrawalState = $withdrawalState;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getWithdrawalState(): ?RevenueWithdrawalState {
        return $this->withdrawalState;
    }

    public function setWithdrawalState(?RevenueWithdrawalState $value): self {
        $this->withdrawalState = $value;
        return $this;
    }

}
