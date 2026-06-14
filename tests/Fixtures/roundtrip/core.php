<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\BotCommand;
use Yabx\Telegram\Objects\CallbackQuery;
use Yabx\Telegram\Objects\Chat;
use Yabx\Telegram\Objects\ForceReply;
use Yabx\Telegram\Objects\InlineKeyboardButton;
use Yabx\Telegram\Objects\InlineQuery;
use Yabx\Telegram\Objects\InputMediaAnimation;
use Yabx\Telegram\Objects\InputMediaAudio;
use Yabx\Telegram\Objects\InputMediaDocument;
use Yabx\Telegram\Objects\InputMediaPhoto;
use Yabx\Telegram\Objects\InputMediaVideo;
use Yabx\Telegram\Objects\LinkPreviewOptions;
use Yabx\Telegram\Objects\MessageEntity;
use Yabx\Telegram\Objects\PhotoSize;
use Yabx\Telegram\Objects\Poll;
use Yabx\Telegram\Objects\PollOption;
use Yabx\Telegram\Objects\ReplyKeyboardRemove;
use Yabx\Telegram\Objects\ReplyParameters;
use Yabx\Telegram\Objects\ReactionTypeEmoji;
use Yabx\Telegram\Objects\User;
use Yabx\Telegram\Objects\WebhookInfo;
use Yabx\Telegram\Tests\Support\SampleData;

return [
    User::class => SampleData::user(),
    Chat::class => SampleData::chat(),
    PhotoSize::class => SampleData::photoSize(),
    BotCommand::class => ['command' => 'start', 'description' => 'Start bot'],
    MessageEntity::class => ['type' => 'bold', 'offset' => 0, 'length' => 4],
    ReplyParameters::class => ['message_id' => 10, 'chat_id' => 123],
    LinkPreviewOptions::class => ['is_disabled' => true],
    InlineKeyboardButton::class => ['text' => 'OK', 'callback_data' => 'ok'],
    ReplyKeyboardRemove::class => ['remove_keyboard' => true],
    ForceReply::class => ['force_reply' => true],
    CallbackQuery::class => [
        'id' => 'cq-1',
        'from' => SampleData::user(),
        'chat_instance' => 'inst',
        'data' => 'ok',
    ],
    InlineQuery::class => [
        'id' => 'iq-1',
        'from' => SampleData::user(),
        'query' => 'test',
        'offset' => '',
    ],
    PollOption::class => ['text' => 'Yes', 'voter_count' => 0],
    Poll::class => [
        'id' => 'poll-1',
        'question' => 'Q?',
        'options' => [['text' => 'Yes', 'voter_count' => 0]],
        'total_voter_count' => 0,
        'is_closed' => false,
        'is_anonymous' => true,
        'type' => 'regular',
        'allows_multiple_answers' => false,
    ],
    WebhookInfo::class => [
        'url' => 'https://example.com/hook',
        'has_custom_certificate' => false,
        'pending_update_count' => 0,
    ],
    InputMediaPhoto::class => ['type' => 'photo', 'media' => 'attach://photo.jpg'],
    InputMediaVideo::class => ['type' => 'video', 'media' => 'attach://video.mp4'],
    InputMediaAudio::class => ['type' => 'audio', 'media' => 'attach://audio.mp3'],
    InputMediaDocument::class => ['type' => 'document', 'media' => 'attach://doc.pdf'],
    InputMediaAnimation::class => ['type' => 'animation', 'media' => 'attach://anim.gif'],
    ReactionTypeEmoji::class => [
        'type' => 'emoji',
        'emoji' => '👍',
    ],
];
