<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\Giveaway;
use Yabx\Telegram\Objects\GiveawayCompleted;
use Yabx\Telegram\Objects\GiveawayCreated;
use Yabx\Telegram\Objects\GiveawayWinners;
use Yabx\Telegram\Tests\Support\SampleData;

return [
    Giveaway::class => [
        'chats' => [SampleData::chat()],
        'winners_selection_date' => 1681221530,
        'winner_count' => 3,
    ],
    GiveawayWinners::class => [
        'chat' => SampleData::chat(),
        'giveaway_message_id' => 10,
        'winners_selection_date' => 1681221530,
        'winner_count' => 1,
        'winners' => [SampleData::user()],
    ],
    GiveawayCreated::class => [
        'prize_star_count' => 100,
    ],
    GiveawayCompleted::class => [
        'winner_count' => 3,
        'is_star_giveaway' => true,
    ],
];
