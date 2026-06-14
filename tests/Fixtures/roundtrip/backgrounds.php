<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\BackgroundFillFreeformGradient;
use Yabx\Telegram\Objects\BackgroundFillGradient;
use Yabx\Telegram\Objects\BackgroundFillSolid;
use Yabx\Telegram\Objects\BackgroundTypeChatTheme;
use Yabx\Telegram\Objects\BackgroundTypeFill;
use Yabx\Telegram\Objects\BackgroundTypePattern;
use Yabx\Telegram\Objects\BackgroundTypeWallpaper;
use Yabx\Telegram\Objects\ChatBackground;

return [
    BackgroundFillSolid::class => [
        'type' => 'solid',
        'color' => 16777215,
    ],
    BackgroundFillGradient::class => [
        'type' => 'gradient',
        'top_color' => 1,
        'bottom_color' => 2,
    ],
    BackgroundFillFreeformGradient::class => [
        'type' => 'freeform_gradient',
        'colors' => [1, 2, 3],
    ],
    BackgroundTypeChatTheme::class => [
        'type' => 'chat_theme',
        'theme_name' => 'dark',
    ],
    BackgroundTypeFill::class => [
        'type' => 'fill',
        'fill' => ['type' => 'solid', 'color' => 1],
        'dark_theme_dimming' => 20,
    ],
    BackgroundTypePattern::class => [
        'type' => 'pattern',
        'document' => ['file_id' => 'f', 'file_unique_id' => 'u'],
        'fill' => ['type' => 'solid', 'color' => 1],
        'intensity' => 50,
    ],
    BackgroundTypeWallpaper::class => [
        'type' => 'wallpaper',
        'document' => ['file_id' => 'f', 'file_unique_id' => 'u'],
        'dark_theme_dimming' => 20,
    ],
    ChatBackground::class => [
        'type' => [
            'type' => 'chat_theme',
            'theme_name' => 'dark',
        ],
    ],
];
