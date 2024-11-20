<?php

namespace Yabx\Telegram\Objects;

final class TransactionPartnerTelegramAds extends TransactionPartner {

    /**
     * Type
     *
     * Type of the transaction partner, always “telegram_ads”
     * @var string
     */
    protected string $type = 'telegram_ads';

    public static function fromArray(array $data): TransactionPartnerTelegramAds {
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
