<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\InlineKeyboardButton;
use Yabx\Telegram\Objects\InlineKeyboardMarkup;
use Yabx\Telegram\Objects\KeyboardButton;
use Yabx\Telegram\Objects\KeyboardButtonPollType;
use Yabx\Telegram\Objects\KeyboardButtonRequestChat;
use Yabx\Telegram\Objects\KeyboardButtonRequestUsers;
use Yabx\Telegram\Objects\KeyboardButtonRequestManagedBot;
use Yabx\Telegram\Objects\LoginUrl;
use Yabx\Telegram\Objects\ReplyKeyboardMarkup;
use Yabx\Telegram\Objects\SwitchInlineQueryChosenChat;
use Yabx\Telegram\Objects\WebAppInfo;

return [
    KeyboardButton::class => ['text' => 'Tap me'],
    KeyboardButtonPollType::class => ['type' => 'quiz'],
    KeyboardButtonRequestUsers::class => [
        'request_id' => 1,
        'user_is_bot' => false,
        'max_quantity' => 3,
    ],
    KeyboardButtonRequestChat::class => [
        'request_id' => 2,
        'chat_is_channel' => false,
        'chat_is_forum' => true,
    ],
    KeyboardButtonRequestManagedBot::class => [
        'request_id' => 3,
        'suggested_name' => 'Helper Bot',
        'suggested_username' => 'helper_bot',
    ],
    SwitchInlineQueryChosenChat::class => [
        'query' => 'share',
        'allow_user_chats' => true,
        'allow_group_chats' => true,
    ],
    ReplyKeyboardMarkup::class => [
        'keyboard' => [[['text' => 'Yes'], ['text' => 'No']]],
        'resize_keyboard' => true,
    ],
    InlineKeyboardMarkup::class => [
        'inline_keyboard' => [[['text' => 'OK', 'callback_data' => 'ok']]],
    ],
    InlineKeyboardButton::class => [
        'text' => 'Share',
        'switch_inline_query_chosen_chat' => [
            'query' => 'share',
            'allow_user_chats' => true,
        ],
    ],
    WebAppInfo::class => ['url' => 'https://example.com/app'],
    LoginUrl::class => [
        'url' => 'https://example.com/login',
        'forward_text' => 'Authorize',
    ],
];
