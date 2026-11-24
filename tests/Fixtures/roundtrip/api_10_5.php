<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\AreaPosition;
use Yabx\Telegram\Objects\BotFullInfo;
use Yabx\Telegram\Objects\ChatShareThemeBackdrop;
use Yabx\Telegram\Objects\ChatShareThemeBackdrops;
use Yabx\Telegram\Objects\ChatShareThemeEmoji;
use Yabx\Telegram\Objects\ChatShareThemeUniqueGift;
use Yabx\Telegram\Objects\EmojiTypeCustomEmoji;
use Yabx\Telegram\Objects\EmojiTypeEmoji;
use Yabx\Telegram\Objects\InputSharedWidgetMessageContent;
use Yabx\Telegram\Objects\InputWidgetMessageContent;
use Yabx\Telegram\Objects\PaidMessagesWaived;
use Yabx\Telegram\Objects\RichTextTonAddress;
use Yabx\Telegram\Objects\SharedWidgetQuery;
use Yabx\Telegram\Objects\TonNft;
use Yabx\Telegram\Objects\TonNftAttribute;
use Yabx\Telegram\Objects\TonWalletCard;
use Yabx\Telegram\Objects\TonWalletCardSticker;
use Yabx\Telegram\Objects\TonWalletTransfer;
use Yabx\Telegram\Objects\Widget;
use Yabx\Telegram\Objects\WidgetQuery;
use Yabx\Telegram\Objects\WidgetQueryTypeData;
use Yabx\Telegram\Objects\WidgetQueryTypeSentTransaction;
use Yabx\Telegram\Objects\WidgetQueryTypeSignData;
use Yabx\Telegram\Objects\WidgetQueryWallet;
use Yabx\Telegram\Tests\Support\SampleData;

$position = [
    'x_percentage' => 10.0,
    'y_percentage' => 20.0,
    'width_percentage' => 30.0,
    'height_percentage' => 40.0,
    'rotation_angle' => 0.0,
    'corner_radius_percentage' => 5.0,
];
$nft = [
    'address' => 'EQNFT',
    'index' => '1',
    'name' => 'Rose',
    'description' => 'A rose',
    'attributes' => [['trait_type' => 'color', 'value' => 'red']],
];
$gift = [
    'gift_id' => 'gift-1',
    'base_name' => 'Rose',
    'name' => 'Rose-1',
    'number' => 1,
];
$user = SampleData::user();

return [
    BotFullInfo::class => [
        'id' => 1,
        'is_bot' => true,
        'first_name' => 'Bot',
        'username' => 'test_bot',
        'active_usernames' => ['test_bot'],
        'can_join_groups' => true,
        'supports_inline_queries' => true,
        'has_topic_sidebar' => false,
    ],
    Widget::class => [
        'id' => 'w1',
        'html' => '<b>hi</b>',
        'public_data' => 'pub',
    ],
    WidgetQueryWallet::class => [
        'address' => 'EQ',
        'amount' => '10',
        'public_key' => 'aa',
    ],
    PaidMessagesWaived::class => [],
    TonNftAttribute::class => ['trait_type' => 'color', 'value' => 'red'],
    TonWalletTransfer::class => [
        'transaction_id' => 'tx',
        'peer_address' => 'EQ',
        'amount' => '-5',
        'comment' => 'hi',
    ],
    AreaPosition::class => $position,
    TonNft::class => $nft,
    TonWalletCardSticker::class => ['position' => $position, 'nft' => $nft],
    TonWalletCard::class => [
        'address' => 'EQ',
        'amount' => '10',
        'stickers' => [['position' => $position, 'nft' => $nft]],
    ],
    EmojiTypeEmoji::class => ['type' => 'emoji', 'emoji' => '⭐'],
    EmojiTypeCustomEmoji::class => ['type' => 'custom_emoji', 'custom_emoji_id' => '99'],
    ChatShareThemeEmoji::class => [
        'type' => 'emoji',
        'emojis' => [['type' => 'emoji', 'emoji' => '⭐']],
        'background_backdrop_id' => 3,
    ],
    ChatShareThemeUniqueGift::class => ['type' => 'unique_gift', 'gift' => $gift],
    ChatShareThemeBackdrop::class => [
        'id' => 3,
        'name' => 'Night',
        'colors' => [
            'center_color' => 1,
            'edge_color' => 2,
            'symbol_color' => 3,
            'text_color' => 4,
        ],
    ],
    ChatShareThemeBackdrops::class => [
        'backdrops' => [[
            'id' => 3,
            'name' => 'Night',
            'colors' => [
                'center_color' => 1,
                'edge_color' => 2,
                'symbol_color' => 3,
                'text_color' => 4,
            ],
        ]],
    ],
    WidgetQueryTypeData::class => ['type' => 'data'],
    WidgetQueryTypeSignData::class => [
        'type' => 'sign_data',
        'wallet' => ['address' => 'EQ', 'amount' => '1'],
        'sign_data' => '{}',
    ],
    WidgetQueryTypeSentTransaction::class => [
        'type' => 'sent_transaction',
        'wallet' => ['address' => 'EQ', 'amount' => '1'],
        'msg_hash' => 'abc',
    ],
    WidgetQuery::class => [
        'id' => 'q1',
        'from' => $user,
        'chat_instance' => 'ci',
        'type' => ['type' => 'data'],
        'data' => 'ping',
    ],
    SharedWidgetQuery::class => [
        'id' => 'q2',
        'from' => $user,
        'type' => ['type' => 'data'],
        'data' => 'ping',
        'widget_id' => 'w1',
    ],
    RichTextTonAddress::class => [
        'type' => 'ton_address',
        'text' => 'wallet',
        'address' => 'EQ',
    ],
    InputWidgetMessageContent::class => [
        'html' => '<b>hi</b>',
        'allow_queries' => true,
    ],
    InputSharedWidgetMessageContent::class => [
        'widget_id' => 'w1',
        'caption' => 'cap',
    ],
];
