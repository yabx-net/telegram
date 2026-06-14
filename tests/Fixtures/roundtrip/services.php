<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\CallbackGame;
use Yabx\Telegram\Objects\ChatOwnerChanged;
use Yabx\Telegram\Objects\ChatOwnerLeft;
use Yabx\Telegram\Objects\MessageAutoDeleteTimerChanged;
use Yabx\Telegram\Objects\PollMedia;
use Yabx\Telegram\Objects\PollOptionAdded;
use Yabx\Telegram\Objects\PollOptionDeleted;
use Yabx\Telegram\Objects\ProximityAlertTriggered;
use Yabx\Telegram\Objects\VideoChatEnded;
use Yabx\Telegram\Objects\VideoChatParticipantsInvited;
use Yabx\Telegram\Objects\VideoChatScheduled;
use Yabx\Telegram\Objects\VideoChatStarted;
use Yabx\Telegram\Tests\Support\SampleData;

$user = SampleData::user();

return [
    VideoChatStarted::class => [],
    VideoChatEnded::class => [
        'duration' => 300,
    ],
    VideoChatScheduled::class => [
        'start_date' => 1681221530,
    ],
    VideoChatParticipantsInvited::class => [
        'users' => [$user],
    ],
    ProximityAlertTriggered::class => [
        'traveler' => $user,
        'watcher' => SampleData::user(2, 'Watcher'),
        'distance' => 100,
    ],
    PollOptionAdded::class => [
        'option_persistent_id' => 'opt-1',
        'option_text' => 'New option',
    ],
    PollOptionDeleted::class => [
        'option_persistent_id' => 'opt-1',
    ],
    MessageAutoDeleteTimerChanged::class => [
        'message_auto_delete_time' => 86400,
    ],
    ChatOwnerChanged::class => [
        'new_owner' => $user,
    ],
    ChatOwnerLeft::class => [],
    CallbackGame::class => [],
    PollMedia::class => [
        'animation' => SampleData::animation(),
    ],
];
