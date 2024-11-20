<?php

namespace Yabx\Telegram\Objects;

final class TransactionPartnerOther extends TransactionPartner {

    /**
     * Type
     *
     * Type of the transaction partner, always “other”
     * @var string
     */
    protected string $type = 'other';

    public static function fromArray(array $data): TransactionPartnerOther {
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
