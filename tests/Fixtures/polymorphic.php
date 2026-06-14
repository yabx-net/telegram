<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\BackgroundFill;
use Yabx\Telegram\Objects\BackgroundFillFreeformGradient;
use Yabx\Telegram\Objects\BackgroundFillGradient;
use Yabx\Telegram\Objects\BackgroundType;
use Yabx\Telegram\Objects\BackgroundTypeChatTheme;
use Yabx\Telegram\Objects\BackgroundTypePattern;
use Yabx\Telegram\Objects\BackgroundTypeWallpaper;
use Yabx\Telegram\Objects\BotCommandScope;
use Yabx\Telegram\Objects\BotCommandScopeAllChatAdministrators;
use Yabx\Telegram\Objects\BotCommandScopeAllGroupChats;
use Yabx\Telegram\Objects\BotCommandScopeAllPrivateChats;
use Yabx\Telegram\Objects\BotCommandScopeChat;
use Yabx\Telegram\Objects\BotCommandScopeChatAdministrators;
use Yabx\Telegram\Objects\BotCommandScopeChatMember;
use Yabx\Telegram\Objects\InlineQueryResult;
use Yabx\Telegram\Objects\InlineQueryResultAudio;
use Yabx\Telegram\Objects\InlineQueryResultContact;
use Yabx\Telegram\Objects\InlineQueryResultDocument;
use Yabx\Telegram\Objects\InlineQueryResultGame;
use Yabx\Telegram\Objects\InlineQueryResultGif;
use Yabx\Telegram\Objects\InlineQueryResultLocation;
use Yabx\Telegram\Objects\InlineQueryResultPhoto;
use Yabx\Telegram\Objects\InlineQueryResultVenue;
use Yabx\Telegram\Objects\InlineQueryResultVideo;
use Yabx\Telegram\Objects\InlineQueryResultVoice;
use Yabx\Telegram\Objects\InputPaidMedia;
use Yabx\Telegram\Objects\InputPaidMediaLivePhoto;
use Yabx\Telegram\Objects\InputPaidMediaVideo;
use Yabx\Telegram\Objects\InputProfilePhoto;
use Yabx\Telegram\Objects\InputProfilePhotoAnimated;
use Yabx\Telegram\Objects\InputStoryContent;
use Yabx\Telegram\Objects\InputStoryContentVideo;
use Yabx\Telegram\Objects\MenuButton;
use Yabx\Telegram\Objects\MenuButtonDefault;
use Yabx\Telegram\Objects\MenuButtonWebApp;
use Yabx\Telegram\Objects\MessageOrigin;
use Yabx\Telegram\Objects\MessageOriginChannel;
use Yabx\Telegram\Objects\MessageOriginChat;
use Yabx\Telegram\Objects\MessageOriginHiddenUser;
use Yabx\Telegram\Objects\OwnedGift;
use Yabx\Telegram\Objects\OwnedGiftUnique;
use Yabx\Telegram\Objects\PaidMedia;
use Yabx\Telegram\Objects\PaidMediaPreview;
use Yabx\Telegram\Objects\PaidMediaVideo;
use Yabx\Telegram\Objects\PassportElementError;
use Yabx\Telegram\Objects\PassportElementErrorFile;
use Yabx\Telegram\Objects\PassportElementErrorFrontSide;
use Yabx\Telegram\Objects\ReactionType;
use Yabx\Telegram\Objects\ReactionTypeCustomEmoji;
use Yabx\Telegram\Objects\ReactionTypePaid;
use Yabx\Telegram\Objects\RevenueWithdrawalState;
use Yabx\Telegram\Objects\RevenueWithdrawalStateFailed;
use Yabx\Telegram\Objects\RevenueWithdrawalStatePending;
use Yabx\Telegram\Objects\StoryAreaType;
use Yabx\Telegram\Objects\StoryAreaTypeLocation;
use Yabx\Telegram\Objects\StoryAreaTypeSuggestedReaction;
use Yabx\Telegram\Objects\StoryAreaTypeUniqueGift;
use Yabx\Telegram\Objects\StoryAreaTypeWeather;
use Yabx\Telegram\Objects\TransactionPartner;
use Yabx\Telegram\Objects\TransactionPartnerFragment;
use Yabx\Telegram\Objects\TransactionPartnerOther;
use Yabx\Telegram\Objects\TransactionPartnerTelegramAds;
use Yabx\Telegram\Objects\TransactionPartnerTelegramApi;
use Yabx\Telegram\Tests\Support\SampleData;

$textContent = ['message_text' => 'Text'];
$user = SampleData::user();
$chat = SampleData::chat();
$photo = SampleData::photoSize();
$video = SampleData::video();

return [
    'MessageOrigin channel' => [MessageOrigin::class, [
        'type' => 'channel',
        'date' => 1,
        'chat' => $chat,
        'message_id' => 10,
    ], MessageOriginChannel::class],

    'MessageOrigin chat' => [MessageOrigin::class, [
        'type' => 'chat',
        'date' => 1,
        'sender_chat' => $chat,
    ], MessageOriginChat::class],

    'MessageOrigin hidden_user' => [MessageOrigin::class, [
        'type' => 'hidden_user',
        'date' => 1,
        'sender_user_name' => 'Hidden',
    ], MessageOriginHiddenUser::class],

    'ReactionType custom_emoji' => [ReactionType::class, [
        'type' => 'custom_emoji',
        'custom_emoji_id' => '1',
    ], ReactionTypeCustomEmoji::class],

    'ReactionType paid' => [ReactionType::class, [
        'type' => 'paid',
    ], ReactionTypePaid::class],

    'MenuButton default' => [MenuButton::class, ['type' => 'default'], MenuButtonDefault::class],

    'MenuButton web_app' => [MenuButton::class, [
        'type' => 'web_app',
        'text' => 'Open',
        'web_app' => ['url' => 'https://example.com'],
    ], MenuButtonWebApp::class],

    'BotCommandScope all_chat_administrators' => [BotCommandScope::class, [
        'type' => 'all_chat_administrators',
    ], BotCommandScopeAllChatAdministrators::class],

    'BotCommandScope all_group_chats' => [BotCommandScope::class, [
        'type' => 'all_group_chats',
    ], BotCommandScopeAllGroupChats::class],

    'BotCommandScope all_private_chats' => [BotCommandScope::class, [
        'type' => 'all_private_chats',
    ], BotCommandScopeAllPrivateChats::class],

    'BotCommandScope chat' => [BotCommandScope::class, [
        'type' => 'chat',
        'chat_id' => -1001234567890,
    ], BotCommandScopeChat::class],

    'BotCommandScope chat_administrators' => [BotCommandScope::class, [
        'type' => 'chat_administrators',
        'chat_id' => -1001234567890,
    ], BotCommandScopeChatAdministrators::class],

    'BotCommandScope chat_member' => [BotCommandScope::class, [
        'type' => 'chat_member',
        'chat_id' => -1001234567890,
        'user_id' => 1,
    ], BotCommandScopeChatMember::class],

    'PaidMedia preview' => [PaidMedia::class, [
        'type' => 'preview',
        'width' => 100,
        'height' => 100,
        'duration' => 5,
    ], PaidMediaPreview::class],

    'PaidMedia video' => [PaidMedia::class, [
        'type' => 'video',
        'video' => $video,
    ], PaidMediaVideo::class],

    'InputPaidMedia video' => [InputPaidMedia::class, [
        'type' => 'video',
        'media' => 'attach://video.mp4',
    ], InputPaidMediaVideo::class],

    'InputPaidMedia live_photo' => [InputPaidMedia::class, [
        'type' => 'live_photo',
        'media' => 'attach://live.jpg',
    ], InputPaidMediaLivePhoto::class],

    'StoryAreaType unique_gift' => [StoryAreaType::class, [
        'type' => 'unique_gift',
        'name' => 'rose-42',
    ], StoryAreaTypeUniqueGift::class],

    'StoryAreaType location' => [StoryAreaType::class, [
        'type' => 'location',
        'latitude' => 53.9,
        'longitude' => 27.56,
    ], StoryAreaTypeLocation::class],

    'StoryAreaType suggested_reaction' => [StoryAreaType::class, [
        'type' => 'suggested_reaction',
        'reaction_type' => ['type' => 'emoji', 'emoji' => '👍'],
    ], StoryAreaTypeSuggestedReaction::class],

    'StoryAreaType weather' => [StoryAreaType::class, [
        'type' => 'weather',
        'temperature' => 20.5,
        'emoji' => '☀️',
        'background_color' => 16777215,
    ], StoryAreaTypeWeather::class],

    'InputProfilePhoto animated' => [InputProfilePhoto::class, [
        'type' => 'animated',
        'animation' => 'attach://anim.tgs',
    ], InputProfilePhotoAnimated::class],

    'InputStoryContent video' => [InputStoryContent::class, [
        'type' => 'video',
        'video' => 'attach://story.mp4',
    ], InputStoryContentVideo::class],

    'OwnedGift unique' => [OwnedGift::class, [
        'type' => 'unique',
        'gift' => [
            'name' => 'gift',
            'number' => 1,
            'model' => ['name' => 'model', 'sticker' => SampleData::sticker(), 'rarity_per_mille' => 10],
            'symbol' => ['name' => 'symbol', 'sticker' => SampleData::sticker(), 'rarity_per_mille' => 10],
            'backdrop' => [
                'name' => 'backdrop',
                'colors' => [
                    'center_color' => 1,
                    'edge_color' => 2,
                    'symbol_color' => 3,
                    'text_color' => 4,
                ],
                'rarity_per_mille' => 10,
            ],
        ],
    ], OwnedGiftUnique::class],

    'TransactionPartner fragment' => [TransactionPartner::class, ['type' => 'fragment'], TransactionPartnerFragment::class],
    'TransactionPartner other' => [TransactionPartner::class, ['type' => 'other'], TransactionPartnerOther::class],
    'TransactionPartner telegram_ads' => [TransactionPartner::class, ['type' => 'telegram_ads'], TransactionPartnerTelegramAds::class],
    'TransactionPartner telegram_api' => [TransactionPartner::class, ['type' => 'telegram_api'], TransactionPartnerTelegramApi::class],

    'BackgroundFill gradient' => [BackgroundFill::class, [
        'type' => 'gradient',
        'top_color' => 1,
        'bottom_color' => 2,
    ], BackgroundFillGradient::class],

    'BackgroundFill freeform_gradient' => [BackgroundFill::class, [
        'type' => 'freeform_gradient',
        'colors' => [1, 2, 3],
    ], BackgroundFillFreeformGradient::class],

    'BackgroundType chat_theme' => [BackgroundType::class, [
        'type' => 'chat_theme',
        'theme_name' => 'dark',
    ], BackgroundTypeChatTheme::class],

    'BackgroundType pattern' => [BackgroundType::class, [
        'type' => 'pattern',
        'document' => ['file_id' => 'f', 'file_unique_id' => 'u'],
        'fill' => ['type' => 'solid', 'color' => 1],
        'intensity' => 50,
    ], BackgroundTypePattern::class],

    'BackgroundType wallpaper' => [BackgroundType::class, [
        'type' => 'wallpaper',
        'document' => ['file_id' => 'f', 'file_unique_id' => 'u'],
        'dark_theme_dimming' => 20,
    ], BackgroundTypeWallpaper::class],

    'PassportElementError front_side' => [PassportElementError::class, [
        'source' => 'front_side',
        'type' => 'passport',
        'file_hash' => 'abc',
        'message' => 'Invalid',
    ], PassportElementErrorFrontSide::class],

    'PassportElementError file' => [PassportElementError::class, [
        'source' => 'file',
        'type' => 'passport',
        'file_hash' => 'abc',
        'message' => 'Invalid',
    ], PassportElementErrorFile::class],

    'RevenueWithdrawalState failed' => [RevenueWithdrawalState::class, [
        'type' => 'failed',
    ], RevenueWithdrawalStateFailed::class],

    'RevenueWithdrawalState pending' => [RevenueWithdrawalState::class, [
        'type' => 'pending',
    ], RevenueWithdrawalStatePending::class],

    'InlineQueryResult photo' => [InlineQueryResult::class, [
        'type' => 'photo',
        'id' => 'p1',
        'photo_url' => 'https://example.com/photo.jpg',
        'thumbnail_url' => 'https://example.com/thumb.jpg',
    ], InlineQueryResultPhoto::class],

    'InlineQueryResult audio' => [InlineQueryResult::class, [
        'type' => 'audio',
        'id' => 'a1',
        'audio_url' => 'https://example.com/audio.mp3',
    ], InlineQueryResultAudio::class],

    'InlineQueryResult contact' => [InlineQueryResult::class, [
        'type' => 'contact',
        'id' => 'c1',
        'phone_number' => '+100',
        'first_name' => 'John',
    ], InlineQueryResultContact::class],

    'InlineQueryResult document' => [InlineQueryResult::class, [
        'type' => 'document',
        'id' => 'd1',
        'title' => 'Doc',
        'document_url' => 'https://example.com/doc.pdf',
    ], InlineQueryResultDocument::class],

    'InlineQueryResult game' => [InlineQueryResult::class, [
        'type' => 'game',
        'id' => 'g1',
        'game_short_name' => 'game',
    ], InlineQueryResultGame::class],

    'InlineQueryResult gif' => [InlineQueryResult::class, [
        'type' => 'gif',
        'id' => 'gif1',
        'gif_url' => 'https://example.com/anim.gif',
    ], InlineQueryResultGif::class],

    'InlineQueryResult location' => [InlineQueryResult::class, [
        'type' => 'location',
        'id' => 'l1',
        'latitude' => 53.9,
        'longitude' => 27.56,
        'title' => 'Place',
    ], InlineQueryResultLocation::class],

    'InlineQueryResult venue' => [InlineQueryResult::class, [
        'type' => 'venue',
        'id' => 'v1',
        'latitude' => 53.9,
        'longitude' => 27.56,
        'title' => 'Place',
        'address' => 'Street',
    ], InlineQueryResultVenue::class],

    'InlineQueryResult video' => [InlineQueryResult::class, [
        'type' => 'video',
        'id' => 'vid1',
        'video_url' => 'https://example.com/video.mp4',
    ], InlineQueryResultVideo::class],

    'InlineQueryResult voice' => [InlineQueryResult::class, [
        'type' => 'voice',
        'id' => 'vo1',
        'voice_url' => 'https://example.com/voice.ogg',
    ], InlineQueryResultVoice::class],
];
