<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\BotAccessSettings;
use Yabx\Telegram\Objects\BotCommandScopeAllChatAdministrators;
use Yabx\Telegram\Objects\BotCommandScopeAllGroupChats;
use Yabx\Telegram\Objects\BotCommandScopeAllPrivateChats;
use Yabx\Telegram\Objects\BotCommandScopeChat;
use Yabx\Telegram\Objects\BotCommandScopeChatAdministrators;
use Yabx\Telegram\Objects\BotCommandScopeChatMember;
use Yabx\Telegram\Objects\BotCommandScopeDefault;
use Yabx\Telegram\Objects\BotDescription;
use Yabx\Telegram\Objects\BotName;
use Yabx\Telegram\Objects\BotShortDescription;
use Yabx\Telegram\Objects\MenuButtonCommands;
use Yabx\Telegram\Objects\MenuButtonDefault;
use Yabx\Telegram\Objects\MenuButtonWebApp;
use Yabx\Telegram\Tests\Support\SampleData;

return [
    BotDescription::class => ['description' => 'A helpful bot'],
    BotName::class => ['name' => 'TestBot'],
    BotShortDescription::class => ['short_description' => 'Helps you test'],
    BotAccessSettings::class => [
        'is_access_restricted' => false,
    ],
    BotCommandScopeDefault::class => ['type' => 'default'],
    BotCommandScopeAllChatAdministrators::class => ['type' => 'all_chat_administrators'],
    BotCommandScopeAllGroupChats::class => ['type' => 'all_group_chats'],
    BotCommandScopeAllPrivateChats::class => ['type' => 'all_private_chats'],
    BotCommandScopeChat::class => [
        'type' => 'chat',
        'chat_id' => -1001234567890,
    ],
    BotCommandScopeChatAdministrators::class => [
        'type' => 'chat_administrators',
        'chat_id' => -1001234567890,
    ],
    BotCommandScopeChatMember::class => [
        'type' => 'chat_member',
        'chat_id' => -1001234567890,
        'user_id' => 1,
    ],
    MenuButtonDefault::class => ['type' => 'default'],
    MenuButtonCommands::class => ['type' => 'commands'],
    MenuButtonWebApp::class => [
        'type' => 'web_app',
        'text' => 'Open',
        'web_app' => ['url' => 'https://example.com'],
    ],
];
