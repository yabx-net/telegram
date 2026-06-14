<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\Game;
use Yabx\Telegram\Objects\GameHighScore;
use Yabx\Telegram\Tests\Support\SampleData;

return [
    Game::class => [
        'title' => 'My Game',
        'description' => 'Fun game',
        'photo' => [SampleData::photoSize()],
    ],
    GameHighScore::class => [
        'position' => 1,
        'user' => SampleData::user(),
        'score' => 9000,
    ],
];
