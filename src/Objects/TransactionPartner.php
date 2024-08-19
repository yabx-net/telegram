<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;
use Yabx\Telegram\ObjectTrait;

abstract class TransactionPartner {

    use ObjectTrait;

    public static function fromArray(array $data): TransactionPartner {
        return match ($data['type']) {
            'fragment' => TransactionPartnerFragment::fromArray($data),
            'other' => TransactionPartnerOther::fromArray($data),
            'telegram_ads' => TransactionPartnerTelegramAds::fromArray($data),
            'user' => TransactionPartnerUser::fromArray($data),
            default => throw new InvalidArgumentException('Invalid transaction type'),
        };
    }

}
