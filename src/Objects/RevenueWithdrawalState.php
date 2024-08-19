<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;
use Yabx\Telegram\ObjectTrait;

abstract class RevenueWithdrawalState {

    use ObjectTrait;

    public static function fromArray(array $data): RevenueWithdrawalState {
        return match ($data['type']) {
            'failed' => RevenueWithdrawalStateFailed::fromArray($data),
            'pending' => RevenueWithdrawalStatePending::fromArray($data),
            'succeeded' => RevenueWithdrawalStateSucceeded::fromArray($data),
            default => throw new InvalidArgumentException('Invalid RevenueWithdrawalState type'),
        };
    }

}
