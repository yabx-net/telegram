<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;


abstract class BotCommandScope extends AbstractObject {

    public static function fromArray(array $data): BotCommandScope {
        return match ($data['type'] ?? null) {
            'all_chat_administrators' => BotCommandScopeAllChatAdministrators::fromArray($data),
            'all_group_chats' => BotCommandScopeAllGroupChats::fromArray($data),
            'all_private_chats' => BotCommandScopeAllPrivateChats::fromArray($data),
            'chat' => BotCommandScopeChat::fromArray($data),
            'chat_administrators' => BotCommandScopeChatAdministrators::fromArray($data),
            'chat_member' => BotCommandScopeChatMember::fromArray($data),
            'default' => BotCommandScopeDefault::fromArray($data),
            default => throw new Exception('Failed to create BotCommandScope')
        };
    }

}
