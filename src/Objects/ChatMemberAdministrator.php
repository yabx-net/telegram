<?php

namespace Yabx\Telegram\Objects;

class ChatMemberAdministrator {

    /**
     * Status
     *
     * The member's status in the chat, always “administrator”
     * @var string
     */
    protected string $status;

    /**
     * User
     *
     * Information about the user
     * @var User
     */
    protected User $user;

    /**
     * Can Be Edited
     *
     * True, if the bot is allowed to edit administrator privileges of that user
     * @var bool
     */
    protected bool $canBeEdited;

    /**
     * Is Anonymous
     *
     * True, if the user's presence in the chat is hidden
     * @var bool
     */
    protected bool $isAnonymous;

    /**
     * Can Manage Chat
     *
     * True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     * @var bool
     */
    protected bool $canManageChat;

    /**
     * Can Delete Messages
     *
     * True, if the administrator can delete messages of other users
     * @var bool
     */
    protected bool $canDeleteMessages;

    /**
     * Can Manage Video Chats
     *
     * True, if the administrator can manage video chats
     * @var bool
     */
    protected bool $canManageVideoChats;

    /**
     * Can Restrict Members
     *
     * True, if the administrator can restrict, ban or unban chat members
     * @var bool
     */
    protected bool $canRestrictMembers;

    /**
     * Can Promote Members
     *
     * True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     * @var bool
     */
    protected bool $canPromoteMembers;

    /**
     * Can Change Info
     *
     * True, if the user is allowed to change the chat title, photo and other settings
     * @var bool
     */
    protected bool $canChangeInfo;

    /**
     * Can Invite Users
     *
     * True, if the user is allowed to invite new users to the chat
     * @var bool
     */
    protected bool $canInviteUsers;

    /**
     * Can Post Messages
     *
     * Optional. True, if the administrator can post in the channel; channels only
     * @var bool|null
     */
    protected ?bool $canPostMessages = null;

    /**
     * Can Edit Messages
     *
     * Optional. True, if the administrator can edit messages of other users and can pin messages; channels only
     * @var bool|null
     */
    protected ?bool $canEditMessages = null;

    /**
     * Can Pin Messages
     *
     * Optional. True, if the user is allowed to pin messages; groups and supergroups only
     * @var bool|null
     */
    protected ?bool $canPinMessages = null;

    /**
     * Can Manage Topics
     *
     * Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; supergroups only
     * @var bool|null
     */
    protected ?bool $canManageTopics = null;

    /**
     * Custom Title
     *
     * Optional. Custom title for this user
     * @var string|null
     */
    protected ?string $customTitle = null;


    public function __construct(array $data) {
        if (isset($data['status'])) {
            $this->status = $data['status'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (isset($data['can_be_edited'])) {
            $this->canBeEdited = $data['can_be_edited'];
        }
        if (isset($data['is_anonymous'])) {
            $this->isAnonymous = $data['is_anonymous'];
        }
        if (isset($data['can_manage_chat'])) {
            $this->canManageChat = $data['can_manage_chat'];
        }
        if (isset($data['can_delete_messages'])) {
            $this->canDeleteMessages = $data['can_delete_messages'];
        }
        if (isset($data['can_manage_video_chats'])) {
            $this->canManageVideoChats = $data['can_manage_video_chats'];
        }
        if (isset($data['can_restrict_members'])) {
            $this->canRestrictMembers = $data['can_restrict_members'];
        }
        if (isset($data['can_promote_members'])) {
            $this->canPromoteMembers = $data['can_promote_members'];
        }
        if (isset($data['can_change_info'])) {
            $this->canChangeInfo = $data['can_change_info'];
        }
        if (isset($data['can_invite_users'])) {
            $this->canInviteUsers = $data['can_invite_users'];
        }
        if (isset($data['can_post_messages'])) {
            $this->canPostMessages = $data['can_post_messages'];
        }
        if (isset($data['can_edit_messages'])) {
            $this->canEditMessages = $data['can_edit_messages'];
        }
        if (isset($data['can_pin_messages'])) {
            $this->canPinMessages = $data['can_pin_messages'];
        }
        if (isset($data['can_manage_topics'])) {
            $this->canManageTopics = $data['can_manage_topics'];
        }
        if (isset($data['custom_title'])) {
            $this->customTitle = $data['custom_title'];
        }
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getCanBeEdited(): bool {
        return $this->canBeEdited;
    }

    public function getIsAnonymous(): bool {
        return $this->isAnonymous;
    }

    public function getCanManageChat(): bool {
        return $this->canManageChat;
    }

    public function getCanDeleteMessages(): bool {
        return $this->canDeleteMessages;
    }

    public function getCanManageVideoChats(): bool {
        return $this->canManageVideoChats;
    }

    public function getCanRestrictMembers(): bool {
        return $this->canRestrictMembers;
    }

    public function getCanPromoteMembers(): bool {
        return $this->canPromoteMembers;
    }

    public function getCanChangeInfo(): bool {
        return $this->canChangeInfo;
    }

    public function getCanInviteUsers(): bool {
        return $this->canInviteUsers;
    }

    public function getCanPostMessages(): ?bool {
        return $this->canPostMessages;
    }

    public function getCanEditMessages(): ?bool {
        return $this->canEditMessages;
    }

    public function getCanPinMessages(): ?bool {
        return $this->canPinMessages;
    }

    public function getCanManageTopics(): ?bool {
        return $this->canManageTopics;
    }

    public function getCustomTitle(): ?string {
        return $this->customTitle;
    }


}
