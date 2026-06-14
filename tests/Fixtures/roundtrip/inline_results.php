<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\InlineQueryResultArticle;
use Yabx\Telegram\Objects\InlineQueryResultAudio;
use Yabx\Telegram\Objects\InlineQueryResultCachedAudio;
use Yabx\Telegram\Objects\InlineQueryResultCachedDocument;
use Yabx\Telegram\Objects\InlineQueryResultCachedGif;
use Yabx\Telegram\Objects\InlineQueryResultCachedPhoto;
use Yabx\Telegram\Objects\InlineQueryResultCachedSticker;
use Yabx\Telegram\Objects\InlineQueryResultCachedVideo;
use Yabx\Telegram\Objects\InlineQueryResultCachedVoice;
use Yabx\Telegram\Objects\InlineQueryResultContact;
use Yabx\Telegram\Objects\InlineQueryResultDocument;
use Yabx\Telegram\Objects\InlineQueryResultGame;
use Yabx\Telegram\Objects\InlineQueryResultGif;
use Yabx\Telegram\Objects\InlineQueryResultLocation;
use Yabx\Telegram\Objects\InlineQueryResultPhoto;
use Yabx\Telegram\Objects\InlineQueryResultVenue;
use Yabx\Telegram\Objects\InlineQueryResultVideo;
use Yabx\Telegram\Objects\InlineQueryResultVoice;
use Yabx\Telegram\Objects\InlineQueryResultsButton;

$textContent = ['message_text' => 'Text'];

return [
    InlineQueryResultArticle::class => [
        'type' => 'article',
        'id' => 'art1',
        'title' => 'Article',
        'input_message_content' => $textContent,
    ],
    InlineQueryResultPhoto::class => [
        'type' => 'photo',
        'id' => 'p1',
        'photo_url' => 'https://example.com/photo.jpg',
        'thumbnail_url' => 'https://example.com/thumb.jpg',
    ],
    InlineQueryResultAudio::class => [
        'type' => 'audio',
        'id' => 'a1',
        'audio_url' => 'https://example.com/audio.mp3',
    ],
    InlineQueryResultContact::class => [
        'type' => 'contact',
        'id' => 'c1',
        'phone_number' => '+100',
        'first_name' => 'John',
    ],
    InlineQueryResultDocument::class => [
        'type' => 'document',
        'id' => 'd1',
        'title' => 'Doc',
        'document_url' => 'https://example.com/doc.pdf',
    ],
    InlineQueryResultGame::class => [
        'type' => 'game',
        'id' => 'g1',
        'game_short_name' => 'game',
    ],
    InlineQueryResultGif::class => [
        'type' => 'gif',
        'id' => 'gif1',
        'gif_url' => 'https://example.com/anim.gif',
    ],
    InlineQueryResultLocation::class => [
        'type' => 'location',
        'id' => 'l1',
        'latitude' => 53.9,
        'longitude' => 27.56,
        'title' => 'Place',
    ],
    InlineQueryResultVenue::class => [
        'type' => 'venue',
        'id' => 'v1',
        'latitude' => 53.9,
        'longitude' => 27.56,
        'title' => 'Place',
        'address' => 'Street',
    ],
    InlineQueryResultVideo::class => [
        'type' => 'video',
        'id' => 'vid1',
        'video_url' => 'https://example.com/video.mp4',
    ],
    InlineQueryResultVoice::class => [
        'type' => 'voice',
        'id' => 'vo1',
        'voice_url' => 'https://example.com/voice.ogg',
    ],
    InlineQueryResultCachedPhoto::class => [
        'type' => 'photo',
        'id' => 'cp1',
        'photo_file_id' => 'AgACAgIAAxkBAAI',
    ],
    InlineQueryResultCachedAudio::class => [
        'type' => 'audio',
        'id' => 'ca1',
        'audio_file_id' => 'CQACAgIAAxkBAAI',
    ],
    InlineQueryResultCachedDocument::class => [
        'type' => 'document',
        'id' => 'cd1',
        'document_file_id' => 'BQACAgIAAxkBAAI',
        'title' => 'Doc',
    ],
    InlineQueryResultCachedGif::class => [
        'type' => 'gif',
        'id' => 'cg1',
        'gif_file_id' => 'CgACAgIAAxkBAAI',
    ],
    InlineQueryResultCachedSticker::class => [
        'type' => 'sticker',
        'id' => 'cs1',
        'sticker_file_id' => 'CAACAgIAAxkBAAI',
    ],
    InlineQueryResultCachedVideo::class => [
        'type' => 'video',
        'id' => 'cv1',
        'video_file_id' => 'BAACAgIAAxkBAAI',
    ],
    InlineQueryResultCachedVoice::class => [
        'type' => 'voice',
        'id' => 'cvo1',
        'voice_file_id' => 'AwACAgIAAxkBAAI',
    ],
    InlineQueryResultsButton::class => [
        'text' => 'Open Web App',
        'web_app' => ['url' => 'https://example.com/app'],
    ],
];
