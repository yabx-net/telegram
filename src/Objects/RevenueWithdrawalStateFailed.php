<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class RevenueWithdrawalStateFailed extends RevenueWithdrawalState {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the state, always “failed”
     * @var string|null
     */
    protected ?string $type = null;

    public static function fromArray(array $data): RevenueWithdrawalStateFailed {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
    ) {
        $this->type = $type;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

}
