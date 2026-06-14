<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\ChatMemberAdministrator;
use Yabx\Telegram\Objects\ChatMemberBanned;
use Yabx\Telegram\Objects\ChatMemberLeft;
use Yabx\Telegram\Objects\ChatMemberMember;
use Yabx\Telegram\Objects\ChatMemberOwner;
use Yabx\Telegram\Objects\ChatMemberRestricted;
use Yabx\Telegram\Tests\Support\SampleData;

$user = SampleData::user();

return [
    ChatMemberOwner::class => [
        'status' => 'creator',
        'user' => $user,
        'is_anonymous' => false,
    ],
    ChatMemberAdministrator::class => [
        'status' => 'administrator',
        'user' => $user,
        'can_be_edited' => false,
        'is_anonymous' => false,
        'can_manage_chat' => true,
        'can_delete_messages' => true,
        'can_manage_video_chats' => true,
        'can_restrict_members' => true,
        'can_promote_members' => false,
        'can_change_info' => true,
        'can_invite_users' => true,
        'can_post_messages' => true,
        'can_edit_messages' => true,
        'can_pin_messages' => true,
    ],
    ChatMemberMember::class => [
        'status' => 'member',
        'user' => $user,
    ],
    ChatMemberRestricted::class => [
        'status' => 'restricted',
        'user' => $user,
        'is_member' => true,
        'can_send_messages' => true,
    ],
    ChatMemberLeft::class => [
        'status' => 'left',
        'user' => $user,
    ],
    ChatMemberBanned::class => [
        'status' => 'kicked',
        'user' => $user,
        'until_date' => 0,
    ],
];
