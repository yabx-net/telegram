<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class StarTransactions {

    use ObjectTrait;

    /**
     * Transactions
     *
     * The list of transactions
     * @var StarTransaction[]|null
     */
    protected ?array $transactions = null;

    public static function fromArray(array $data): StarTransactions {
        $instance = new self();
        if (isset($data['transactions'])) {
            $instance->transactions = [];
            foreach ($data['transactions'] as $item) {
                $instance->transactions[] = StarTransaction::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?array $transactions = null,
    ) {
        $this->transactions = $transactions;
    }

    public function getTransactions(): ?array {
        return $this->transactions;
    }

    public function setTransactions(?array $value): self {
        $this->transactions = $value;
        return $this;
    }

}
