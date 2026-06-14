<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\BusinessBotRights;
use Yabx\Telegram\Objects\BusinessConnection;
use Yabx\Telegram\Objects\BusinessIntro;
use Yabx\Telegram\Objects\BusinessLocation;
use Yabx\Telegram\Objects\BusinessMessagesDeleted;
use Yabx\Telegram\Objects\BusinessOpeningHours;
use Yabx\Telegram\Objects\BusinessOpeningHoursInterval;
use Yabx\Telegram\Objects\ChatJoinRequest;
use Yabx\Telegram\Objects\ChosenInlineResult;
use Yabx\Telegram\Objects\MessageReactionCountUpdated;
use Yabx\Telegram\Objects\MessageReactionUpdated;
use Yabx\Telegram\Objects\PaidMediaPurchased;
use Yabx\Telegram\Objects\ReactionCount;
use Yabx\Telegram\Objects\SuggestedPostApprovalFailed;
use Yabx\Telegram\Objects\SuggestedPostApproved;
use Yabx\Telegram\Objects\SuggestedPostDeclined;
use Yabx\Telegram\Objects\SuggestedPostInfo;
use Yabx\Telegram\Objects\SuggestedPostPaid;
use Yabx\Telegram\Objects\SuggestedPostParameters;
use Yabx\Telegram\Objects\SuggestedPostPrice;
use Yabx\Telegram\Objects\SuggestedPostRefunded;
use Yabx\Telegram\Tests\Support\SampleData;

return [
    BusinessConnection::class => [
        'id' => 'bc-1',
        'user' => SampleData::user(),
        'user_chat_id' => 630692,
        'date' => 1681135130,
        'can_reply' => true,
        'is_enabled' => true,
    ],
    BusinessMessagesDeleted::class => [
        'business_connection_id' => 'bc-1',
        'chat' => SampleData::privateChat(),
        'message_ids' => [10, 11],
    ],
    ChatJoinRequest::class => [
        'chat' => SampleData::chat(),
        'from' => SampleData::user(),
        'user_chat_id' => 630692,
        'date' => 1681135130,
        'bio' => 'Hello',
    ],
    ChosenInlineResult::class => [
        'result_id' => 'article-1',
        'from' => SampleData::user(),
        'query' => 'telegram',
    ],
    PaidMediaPurchased::class => [
        'from' => SampleData::user(),
        'paid_media_payload' => 'payload-1',
    ],
    SuggestedPostPrice::class => [
        'currency' => 'XTR',
        'amount' => 100,
    ],
    SuggestedPostParameters::class => [
        'price' => ['currency' => 'XTR', 'amount' => 100],
        'send_date' => 1681221530,
    ],
    SuggestedPostInfo::class => [
        'state' => 'pending',
        'price' => ['currency' => 'XTR', 'amount' => 100],
    ],
    SuggestedPostApproved::class => [
        'price' => ['currency' => 'XTR', 'amount' => 100],
        'send_date' => 1681221530,
    ],
    SuggestedPostDeclined::class => [
        'comment' => 'Not suitable',
    ],
    SuggestedPostPaid::class => [
        'currency' => 'XTR',
        'star_amount' => ['amount' => 100],
    ],
    SuggestedPostRefunded::class => [
        'reason' => 'payment_refunded',
    ],
    SuggestedPostApprovalFailed::class => [
        'price' => ['currency' => 'XTR', 'amount' => 100],
    ],
    ReactionCount::class => [
        'type' => ['type' => 'emoji', 'emoji' => '👍'],
        'total_count' => 3,
    ],
    MessageReactionUpdated::class => [
        'chat' => SampleData::chat(),
        'message_id' => 50,
        'user' => SampleData::user(),
        'date' => 1681135130,
        'old_reaction' => [],
        'new_reaction' => [['type' => 'emoji', 'emoji' => '👍']],
    ],
    MessageReactionCountUpdated::class => [
        'chat' => SampleData::chat(),
        'message_id' => 50,
        'date' => 1681135130,
        'reactions' => [
            ['type' => ['type' => 'emoji', 'emoji' => '👍'], 'total_count' => 3],
        ],
    ],
    BusinessIntro::class => [
        'title' => 'Welcome',
        'message' => 'How can we help?',
    ],
    BusinessLocation::class => [
        'address' => '123 Main St',
        'location' => SampleData::location(),
    ],
    BusinessOpeningHoursInterval::class => [
        'opening_minute' => 540,
        'closing_minute' => 1020,
    ],
    BusinessOpeningHours::class => [
        'time_zone_name' => 'Europe/Moscow',
        'opening_hours' => [
            ['opening_minute' => 540, 'closing_minute' => 1020],
        ],
    ],
    BusinessBotRights::class => [
        'can_reply' => true,
        'can_read_messages' => true,
    ],
];
