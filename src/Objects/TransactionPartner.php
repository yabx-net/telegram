<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;


abstract class TransactionPartner extends AbstractObject {

    public static function fromArray(array $data): TransactionPartner {
        return match ($data['type']) {
            'fragment' => TransactionPartnerFragment::fromArray($data),
            'other' => TransactionPartnerOther::fromArray($data),
            'telegram_ads' => TransactionPartnerTelegramAds::fromArray($data),
            'telegram_api' => TransactionPartnerTelegramApi::fromArray($data),
            'user' => TransactionPartnerUser::fromArray($data),
            default => throw new InvalidArgumentException('Invalid transaction type'),
        };
    }

}
