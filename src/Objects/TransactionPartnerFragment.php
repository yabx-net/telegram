<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class TransactionPartnerFragment extends TransactionPartner {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the transaction partner, always “fragment”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Withdrawal State
     *
     * Optional. State of the transaction if the transaction is outgoing
     * @var RevenueWithdrawalState|null
     */
    protected ?RevenueWithdrawalState $withdrawalState = null;

    public function __construct(
        ?string                 $type = null,
        ?RevenueWithdrawalState $withdrawalState = null,
    ) {
        $this->type = $type;
        $this->withdrawalState = $withdrawalState;
    }

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

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getWithdrawalState(): ?RevenueWithdrawalState {
        return $this->withdrawalState;
    }

    public function setWithdrawalState(?RevenueWithdrawalState $value): self {
        $this->withdrawalState = $value;
        return $this;
    }

}
