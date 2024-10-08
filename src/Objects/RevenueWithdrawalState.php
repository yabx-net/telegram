<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;


abstract class RevenueWithdrawalState extends AbstractObject {

    public static function fromArray(array $data): RevenueWithdrawalState {
        return match ($data['type']) {
            'failed' => RevenueWithdrawalStateFailed::fromArray($data),
            'pending' => RevenueWithdrawalStatePending::fromArray($data),
            'succeeded' => RevenueWithdrawalStateSucceeded::fromArray($data),
            default => throw new InvalidArgumentException('Invalid RevenueWithdrawalState type'),
        };
    }

}
