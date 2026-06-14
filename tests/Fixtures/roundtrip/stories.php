<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\InputRichMessage;
use Yabx\Telegram\Objects\InputRichMessageContent;
use Yabx\Telegram\Objects\InputStoryContentPhoto;
use Yabx\Telegram\Objects\InputStoryContentVideo;
use Yabx\Telegram\Objects\RichBlockCaption;
use Yabx\Telegram\Objects\RichBlockListItem;
use Yabx\Telegram\Objects\RichBlockTableCell;
use Yabx\Telegram\Objects\RichMessage;
use Yabx\Telegram\Objects\Story;
use Yabx\Telegram\Objects\StoryArea;
use Yabx\Telegram\Objects\StoryAreaPosition;
use Yabx\Telegram\Objects\StoryAreaTypeLink;
use Yabx\Telegram\Objects\StoryAreaTypeLocation;
use Yabx\Telegram\Objects\StoryAreaTypeSuggestedReaction;
use Yabx\Telegram\Objects\StoryAreaTypeUniqueGift;
use Yabx\Telegram\Objects\StoryAreaTypeWeather;
use Yabx\Telegram\Tests\Support\SampleData;

$paragraph = ['type' => 'paragraph', 'text' => 'Hello'];

return [
    RichMessage::class => [
        'blocks' => [$paragraph],
        'is_rtl' => false,
    ],
    InputRichMessage::class => [
        'html' => '<b>Hello</b>',
        'is_rtl' => false,
    ],
    InputRichMessageContent::class => [
        'rich_message' => ['markdown' => '*Hello*'],
    ],
    RichBlockCaption::class => [
        'text' => 'Caption',
        'credit' => 'Author',
    ],
    RichBlockListItem::class => [
        'label' => 'Item',
        'blocks' => [$paragraph],
    ],
    RichBlockTableCell::class => [
        'text' => 'Cell',
        'is_header' => true,
        'colspan' => 2,
    ],
    Story::class => [
        'chat' => SampleData::chat(),
        'id' => 42,
    ],
    StoryAreaPosition::class => [
        'x_percentage' => 50.0,
        'y_percentage' => 50.0,
        'width_percentage' => 20.0,
        'height_percentage' => 10.0,
        'rotation_angle' => 0.0,
    ],
    StoryArea::class => [
        'position' => [
            'x_percentage' => 50.0,
            'y_percentage' => 50.0,
            'width_percentage' => 20.0,
            'height_percentage' => 10.0,
            'rotation_angle' => 0.0,
        ],
        'type' => ['type' => 'link', 'url' => 'https://example.com'],
    ],
    InputStoryContentPhoto::class => [
        'type' => 'photo',
        'photo' => 'attach://story.jpg',
    ],
    InputStoryContentVideo::class => [
        'type' => 'video',
        'video' => 'attach://story.mp4',
    ],
    StoryAreaTypeUniqueGift::class => [
        'type' => 'unique_gift',
        'name' => 'rose-42',
    ],
    StoryAreaTypeLink::class => [
        'type' => 'link',
        'url' => 'https://example.com',
    ],
    StoryAreaTypeLocation::class => [
        'type' => 'location',
        'latitude' => 53.9,
        'longitude' => 27.56,
    ],
    StoryAreaTypeSuggestedReaction::class => [
        'type' => 'suggested_reaction',
        'reaction_type' => ['type' => 'emoji', 'emoji' => '👍'],
    ],
    StoryAreaTypeWeather::class => [
        'type' => 'weather',
        'temperature' => 20.5,
        'emoji' => '☀️',
        'background_color' => 16777215,
    ],
];
