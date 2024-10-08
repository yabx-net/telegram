<?php

namespace Yabx\Telegram\Objects;

use Exception;


abstract class ChatMember extends AbstractObject {

    public static function fromArray(array $data): ChatMember {
        return match ($data['status'] ?? null) {
            'administrator' => ChatMemberAdministrator::fromArray($data),
            'kicked' => ChatMemberBanned::fromArray($data),
            'left' => ChatMemberLeft::fromArray($data),
            'member' => ChatMemberMember::fromArray($data),
            'creator' => ChatMemberOwner::fromArray($data),
            'restricted' => ChatMemberRestricted::fromArray($data),
            default => throw new Exception('Failed to create ChatMember')
        };
    }

}
