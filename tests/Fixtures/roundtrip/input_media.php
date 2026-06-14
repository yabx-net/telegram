<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\InputMediaLink;
use Yabx\Telegram\Objects\InputMediaLivePhoto;
use Yabx\Telegram\Objects\InputMediaLocation;
use Yabx\Telegram\Objects\InputMediaSticker;
use Yabx\Telegram\Objects\InputMediaVenue;
use Yabx\Telegram\Objects\Link;

return [
    InputMediaSticker::class => ['type' => 'sticker', 'media' => 'attach://sticker.webp'],
    InputMediaLocation::class => [
        'type' => 'location',
        'latitude' => 53.9,
        'longitude' => 27.56,
    ],
    InputMediaVenue::class => [
        'type' => 'venue',
        'latitude' => 53.9,
        'longitude' => 27.56,
        'title' => 'Place',
        'address' => 'Street 1',
    ],
    InputMediaLivePhoto::class => [
        'type' => 'live_photo',
        'media' => 'attach://live.mp4',
        'photo' => 'attach://cover.jpg',
    ],
    InputMediaLink::class => ['type' => 'link', 'url' => 'https://example.com'],
    Link::class => ['url' => 'https://example.com'],
];
