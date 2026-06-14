<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\Birthdate;
use Yabx\Telegram\Objects\CopyTextButton;
use Yabx\Telegram\Objects\ExternalReplyInfo;
use Yabx\Telegram\Objects\InaccessibleMessage;
use Yabx\Telegram\Objects\MaybeInaccessibleMessage;
use Yabx\Telegram\Objects\MessageId;
use Yabx\Telegram\Objects\MessageOriginChannel;
use Yabx\Telegram\Objects\MessageOriginChat;
use Yabx\Telegram\Objects\MessageOriginHiddenUser;
use Yabx\Telegram\Objects\MessageOriginUser;
use Yabx\Telegram\Objects\ResponseParameters;
use Yabx\Telegram\Objects\StarTransactions;
use Yabx\Telegram\Objects\TextQuote;
use Yabx\Telegram\Objects\WriteAccessAllowed;
use Yabx\Telegram\Tests\Support\SampleData;

$user = SampleData::user();
$chat = SampleData::chat();

return [
    TextQuote::class => [
        'text' => 'quoted part',
        'position' => 0,
        'is_manual' => true,
    ],
    InaccessibleMessage::class => [
        'chat' => SampleData::chat(),
        'message_id' => 42,
        'date' => 0,
    ],
    MaybeInaccessibleMessage::class => SampleData::message(),
    ExternalReplyInfo::class => [
        'origin' => [
            'type' => 'user',
            'date' => 1681135130,
            'sender_user' => $user,
        ],
        'photo' => [SampleData::photoSize()],
    ],
    MessageOriginUser::class => [
        'type' => 'user',
        'date' => 1681135130,
        'sender_user' => $user,
    ],
    MessageOriginChannel::class => [
        'type' => 'channel',
        'date' => 1681135130,
        'chat' => $chat,
        'message_id' => 10,
    ],
    MessageOriginChat::class => [
        'type' => 'chat',
        'date' => 1681135130,
        'sender_chat' => $chat,
    ],
    MessageOriginHiddenUser::class => [
        'type' => 'hidden_user',
        'date' => 1681135130,
        'sender_user_name' => 'Hidden',
    ],
    MessageId::class => [
        'message_id' => 42,
    ],
    ResponseParameters::class => [
        'retry_after' => 30,
    ],
    Birthdate::class => [
        'day' => 15,
        'month' => 6,
        'year' => 1990,
    ],
    WriteAccessAllowed::class => [
        'from_request' => true,
        'web_app_name' => 'MyApp',
    ],
    CopyTextButton::class => [
        'text' => 'Copy me',
    ],
    StarTransactions::class => [
        'transactions' => [
            ['id' => 'tx-1', 'amount' => 50, 'date' => 1681135130],
        ],
    ],
];
