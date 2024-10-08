<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;


abstract class MessageOrigin extends AbstractObject {

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
