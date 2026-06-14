<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\ChatAdministratorRights;
use Yabx\Telegram\Objects\ChatInviteLink;
use Yabx\Telegram\Objects\ChatPermissions;
use Yabx\Telegram\Objects\ForumTopic;
use Yabx\Telegram\Objects\ForumTopicClosed;
use Yabx\Telegram\Objects\ForumTopicCreated;
use Yabx\Telegram\Objects\ForumTopicEdited;
use Yabx\Telegram\Objects\ForumTopicReopened;
use Yabx\Telegram\Objects\GeneralForumTopicHidden;
use Yabx\Telegram\Objects\GeneralForumTopicUnhidden;
use Yabx\Telegram\Tests\Support\SampleData;

return [
    ForumTopic::class => [
        'message_thread_id' => 42,
        'name' => 'General',
        'icon_color' => 7322096,
    ],
    ChatPermissions::class => [
        'can_send_messages' => true,
        'can_send_photos' => true,
        'can_send_videos' => false,
        'can_invite_users' => true,
    ],
    ChatInviteLink::class => [
        'invite_link' => 'https://t.me/+invite',
        'creator' => SampleData::user(),
        'creates_join_request' => false,
        'is_primary' => true,
        'is_revoked' => false,
    ],
    ChatAdministratorRights::class => [
        'is_anonymous' => false,
        'can_manage_chat' => true,
        'can_delete_messages' => true,
        'can_manage_video_chats' => true,
        'can_restrict_members' => true,
        'can_promote_members' => false,
        'can_change_info' => true,
        'can_invite_users' => true,
        'can_post_stories' => true,
        'can_edit_stories' => true,
        'can_delete_stories' => true,
        'can_post_messages' => true,
        'can_edit_messages' => true,
        'can_pin_messages' => true,
    ],
    ForumTopicCreated::class => [
        'name' => 'General',
        'icon_color' => 7322096,
    ],
    ForumTopicClosed::class => [],
    ForumTopicEdited::class => [
        'name' => 'Renamed',
    ],
    ForumTopicReopened::class => [],
    GeneralForumTopicHidden::class => [],
    GeneralForumTopicUnhidden::class => [],
];
