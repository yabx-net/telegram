<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\ChatBoostAdded;
use Yabx\Telegram\Objects\ChatBoostSourceGiftCode;
use Yabx\Telegram\Objects\ChatBoostSourceGiveaway;
use Yabx\Telegram\Objects\ChatBoostSourcePremium;
use Yabx\Telegram\Objects\ChatFullInfo;
use Yabx\Telegram\Objects\ChatLocation;
use Yabx\Telegram\Objects\ChatShared;
use Yabx\Telegram\Objects\DirectMessagePriceChanged;
use Yabx\Telegram\Objects\DirectMessagesTopic;
use Yabx\Telegram\Objects\LocationAddress;
use Yabx\Telegram\Objects\ManagedBotCreated;
use Yabx\Telegram\Objects\ManagedBotUpdated;
use Yabx\Telegram\Objects\PaidMessagePriceChanged;
use Yabx\Telegram\Objects\PreparedInlineMessage;
use Yabx\Telegram\Objects\PreparedKeyboardButton;
use Yabx\Telegram\Objects\SentGuestMessage;
use Yabx\Telegram\Objects\SentWebAppMessage;
use Yabx\Telegram\Objects\SharedUser;
use Yabx\Telegram\Objects\UserChatBoosts;
use Yabx\Telegram\Objects\UserProfileAudios;
use Yabx\Telegram\Objects\UserProfilePhotos;
use Yabx\Telegram\Objects\UserRating;
use Yabx\Telegram\Objects\UsersShared;
use Yabx\Telegram\Objects\WebAppData;
use Yabx\Telegram\Tests\Support\SampleData;

$user = SampleData::user();
$photo = SampleData::photoSize();

return [
    ChatShared::class => [
        'request_id' => 1,
        'chat_id' => -1001234567890,
        'title' => 'Test Group',
    ],
    UsersShared::class => [
        'request_id' => 1,
        'users' => [
            ['user_id' => 1, 'first_name' => 'Test'],
        ],
    ],
    SharedUser::class => [
        'user_id' => 1,
        'first_name' => 'Test',
    ],
    WebAppData::class => [
        'data' => '{"key":"value"}',
        'button_text' => 'Open',
    ],
    SentWebAppMessage::class => [
        'inline_message_id' => 'inline-msg-1',
    ],
    SentGuestMessage::class => [
        'inline_message_id' => 'inline-msg-1',
    ],
    ChatLocation::class => [
        'location' => SampleData::location(),
        'address' => '123 Main St',
    ],
    ChatFullInfo::class => [
        'id' => -1001234567890,
        'type' => 'supergroup',
        'title' => 'Test Group',
    ],
    ChatBoostAdded::class => [
        'boost_count' => 1,
    ],
    ChatBoostSourcePremium::class => [
        'source' => 'premium',
        'user' => $user,
    ],
    ChatBoostSourceGiftCode::class => [
        'source' => 'gift_code',
        'user' => $user,
    ],
    ChatBoostSourceGiveaway::class => [
        'source' => 'giveaway',
        'giveaway_message_id' => 10,
        'is_unclaimed' => false,
    ],
    DirectMessagesTopic::class => [
        'topic_id' => 1,
        'user' => $user,
    ],
    DirectMessagePriceChanged::class => [
        'are_direct_messages_enabled' => true,
        'direct_message_star_count' => 10,
    ],
    PaidMessagePriceChanged::class => [
        'paid_message_star_count' => 5,
    ],
    LocationAddress::class => [
        'country_code' => 'BY',
        'state' => 'Minsk',
        'city' => 'Minsk',
        'street' => 'Main St',
    ],
    ManagedBotCreated::class => [
        'bot' => SampleData::bot(),
    ],
    ManagedBotUpdated::class => [
        'bot' => SampleData::bot(),
    ],
    PreparedInlineMessage::class => [
        'id' => 'prep-1',
        'expiration_date' => 1681221530,
    ],
    PreparedKeyboardButton::class => [
        'id' => 'btn-1',
    ],
    UserChatBoosts::class => [
        'boosts' => [
            [
                'boost_id' => 'boost-1',
                'add_date' => 1681135130,
                'expiration_date' => 1681221530,
            ],
        ],
    ],
    UserProfilePhotos::class => [
        'total_count' => 1,
        'photos' => [$photo],
    ],
    UserProfileAudios::class => [
        'total_count' => 1,
        'audios' => [SampleData::audio()],
    ],
    UserRating::class => [
        'level' => 5,
        'rating' => 100,
        'current_level_rating' => 50,
        'next_level_rating' => 200,
    ],
];
