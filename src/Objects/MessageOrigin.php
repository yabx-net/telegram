<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;
use Yabx\Telegram\ObjectTrait;

abstract class MessageOrigin {

    use ObjectTrait;

    public static function fromArray(array $data): MessageOrigin {
        return match ($data['type']) {
            'channel' => MessageOriginChannel::fromArray($data),
            'chat' => MessageOriginChat::fromArray($data),
            'hidden_user' => MessageOriginHiddenUser::fromArray($data),
            'user' => MessageOriginUser::fromArray($data),
            default => throw new InvalidArgumentException('Invalid message origin'),
        };
    }

}
