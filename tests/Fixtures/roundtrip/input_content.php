<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\InputContactMessageContent;
use Yabx\Telegram\Objects\InputFile;
use Yabx\Telegram\Objects\InputInvoiceMessageContent;
use Yabx\Telegram\Objects\InputLocationMessageContent;
use Yabx\Telegram\Objects\InputPaidMediaLivePhoto;
use Yabx\Telegram\Objects\InputPaidMediaPhoto;
use Yabx\Telegram\Objects\InputPaidMediaVideo;
use Yabx\Telegram\Objects\InputPollOption;
use Yabx\Telegram\Objects\InputProfilePhotoAnimated;
use Yabx\Telegram\Objects\InputProfilePhotoStatic;
use Yabx\Telegram\Objects\InputSticker;
use Yabx\Telegram\Objects\InputTextMessageContent;
use Yabx\Telegram\Objects\InputVenueMessageContent;

return [
    InputTextMessageContent::class => [
        'message_text' => 'Hello from inline',
    ],
    InputLocationMessageContent::class => [
        'latitude' => 53.9,
        'longitude' => 27.56,
    ],
    InputVenueMessageContent::class => [
        'latitude' => 53.9,
        'longitude' => 27.56,
        'title' => 'Place',
        'address' => 'Street',
    ],
    InputContactMessageContent::class => [
        'phone_number' => '+10000000000',
        'first_name' => 'John',
    ],
    InputInvoiceMessageContent::class => [
        'title' => 'Premium',
        'description' => 'One month',
        'payload' => 'premium',
        'currency' => 'XTR',
        'prices' => [['label' => 'Premium', 'amount' => 100]],
    ],
    InputPollOption::class => [
        'text' => 'Option A',
    ],
    InputSticker::class => [
        'sticker' => 'attach://sticker.webp',
        'format' => 'static',
        'emoji_list' => ['😀'],
    ],
    InputFile::class => [],
    InputProfilePhotoStatic::class => [
        'type' => 'static',
        'photo' => 'attach://photo.jpg',
    ],
    InputProfilePhotoAnimated::class => [
        'type' => 'animated',
        'animation' => 'attach://anim.tgs',
    ],
    InputPaidMediaPhoto::class => [
        'type' => 'photo',
        'media' => 'attach://photo.jpg',
    ],
    InputPaidMediaVideo::class => [
        'type' => 'video',
        'media' => 'attach://video.mp4',
    ],
    InputPaidMediaLivePhoto::class => [
        'type' => 'live_photo',
        'media' => 'attach://live.jpg',
    ],
];
