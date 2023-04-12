<?php

namespace Yabx\Telegram\Objects;

class ChatMemberAdministrator extends ChatMember {

    /**
     * Status
     *
     * The member's status in the chat, always “administrator”
     * @var string|null
     */
    protected ?string $status = null;

    /**
     * User
     *
     * Information about the user
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Can Be Edited
     *
     * True, if the bot is allowed to edit administrator privileges of that user
     * @var bool|null
     */
    protected ?bool $canBeEdited = null;

    /**
     * Is Anonymous
     *
     * True, if the user's presence in the chat is hidden
     * @var bool|null
     */
    protected ?bool $isAnonymous = null;

    /**
     * Can Manage Chat
     *
     * True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     * @var bool|null
     */
    protected ?bool $canManageChat = null;

    /**
     * Can Delete Messages
     *
     * True, if the administrator can delete messages of other users
     * @var bool|null
     */
    protected ?bool $canDeleteMessages = null;

    /**
     * Can Manage Video Chats
     *
     * True, if the administrator can manage video chats
     * @var bool|null
     */
    protected ?bool $canManageVideoChats = null;

    /**
     * Can Restrict Members
     *
     * True, if the administrator can restrict, ban or unban chat members
     * @var bool|null
     */
    protected ?bool $canRestrictMembers = null;

    /**
     * Can Promote Members
     *
     * True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     * @var bool|null
     */
    protected ?bool $canPromoteMembers = null;

    /**
     * Can Change Info
     *
     * True, if the user is allowed to change the chat title, photo and other settings
     * @var bool|null
     */
    protected ?bool $canChangeInfo = null;

    /**
     * Can Invite Users
     *
     * True, if the user is allowed to invite new users to the chat
     * @var bool|null
     */
    protected ?bool $canInviteUsers = null;

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

    public function __construct(
        ?string $status = null,
        ?User   $user = null,
        ?bool   $canBeEdited = null,
        ?bool   $isAnonymous = null,
        ?bool   $canManageChat = null,
        ?bool   $canDeleteMessages = null,
        ?bool   $canManageVideoChats = null,
        ?bool   $canRestrictMembers = null,
        ?bool   $canPromoteMembers = null,
        ?bool   $canChangeInfo = null,
        ?bool   $canInviteUsers = null,
        ?bool   $canPostMessages = null,
        ?bool   $canEditMessages = null,
        ?bool   $canPinMessages = null,
        ?bool   $canManageTopics = null,
        ?string $customTitle = null,
    ) {
        $this->status = $status;
        $this->user = $user;
        $this->canBeEdited = $canBeEdited;
        $this->isAnonymous = $isAnonymous;
        $this->canManageChat = $canManageChat;
        $this->canDeleteMessages = $canDeleteMessages;
        $this->canManageVideoChats = $canManageVideoChats;
        $this->canRestrictMembers = $canRestrictMembers;
        $this->canPromoteMembers = $canPromoteMembers;
        $this->canChangeInfo = $canChangeInfo;
        $this->canInviteUsers = $canInviteUsers;
        $this->canPostMessages = $canPostMessages;
        $this->canEditMessages = $canEditMessages;
        $this->canPinMessages = $canPinMessages;
        $this->canManageTopics = $canManageTopics;
        $this->customTitle = $customTitle;
    }

    public static function fromArray(array $data): ChatMemberAdministrator {
        $instance = new self();
        if (isset($data['status'])) {
            $instance->status = $data['status'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['can_be_edited'])) {
            $instance->canBeEdited = $data['can_be_edited'];
        }
        if (isset($data['is_anonymous'])) {
            $instance->isAnonymous = $data['is_anonymous'];
        }
        if (isset($data['can_manage_chat'])) {
            $instance->canManageChat = $data['can_manage_chat'];
        }
        if (isset($data['can_delete_messages'])) {
            $instance->canDeleteMessages = $data['can_delete_messages'];
        }
        if (isset($data['can_manage_video_chats'])) {
            $instance->canManageVideoChats = $data['can_manage_video_chats'];
        }
        if (isset($data['can_restrict_members'])) {
            $instance->canRestrictMembers = $data['can_restrict_members'];
        }
        if (isset($data['can_promote_members'])) {
            $instance->canPromoteMembers = $data['can_promote_members'];
        }
        if (isset($data['can_change_info'])) {
            $instance->canChangeInfo = $data['can_change_info'];
        }
        if (isset($data['can_invite_users'])) {
            $instance->canInviteUsers = $data['can_invite_users'];
        }
        if (isset($data['can_post_messages'])) {
            $instance->canPostMessages = $data['can_post_messages'];
        }
        if (isset($data['can_edit_messages'])) {
            $instance->canEditMessages = $data['can_edit_messages'];
        }
        if (isset($data['can_pin_messages'])) {
            $instance->canPinMessages = $data['can_pin_messages'];
        }
        if (isset($data['can_manage_topics'])) {
            $instance->canManageTopics = $data['can_manage_topics'];
        }
        if (isset($data['custom_title'])) {
            $instance->customTitle = $data['custom_title'];
        }
        return $instance;
    }

    public function getStatus(): ?string {
        return $this->status;
    }

    public function setStatus(?string $value): self {
        $this->status = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getCanBeEdited(): ?bool {
        return $this->canBeEdited;
    }

    public function setCanBeEdited(?bool $value): self {
        $this->canBeEdited = $value;
        return $this;
    }

    public function getIsAnonymous(): ?bool {
        return $this->isAnonymous;
    }

    public function setIsAnonymous(?bool $value): self {
        $this->isAnonymous = $value;
        return $this;
    }

    public function getCanManageChat(): ?bool {
        return $this->canManageChat;
    }

    public function setCanManageChat(?bool $value): self {
        $this->canManageChat = $value;
        return $this;
    }

    public function getCanDeleteMessages(): ?bool {
        return $this->canDeleteMessages;
    }

    public function setCanDeleteMessages(?bool $value): self {
        $this->canDeleteMessages = $value;
        return $this;
    }

    public function getCanManageVideoChats(): ?bool {
        return $this->canManageVideoChats;
    }

    public function setCanManageVideoChats(?bool $value): self {
        $this->canManageVideoChats = $value;
        return $this;
    }

    public function getCanRestrictMembers(): ?bool {
        return $this->canRestrictMembers;
    }

    public function setCanRestrictMembers(?bool $value): self {
        $this->canRestrictMembers = $value;
        return $this;
    }

    public function getCanPromoteMembers(): ?bool {
        return $this->canPromoteMembers;
    }

    public function setCanPromoteMembers(?bool $value): self {
        $this->canPromoteMembers = $value;
        return $this;
    }

    public function getCanChangeInfo(): ?bool {
        return $this->canChangeInfo;
    }

    public function setCanChangeInfo(?bool $value): self {
        $this->canChangeInfo = $value;
        return $this;
    }

    public function getCanInviteUsers(): ?bool {
        return $this->canInviteUsers;
    }

    public function setCanInviteUsers(?bool $value): self {
        $this->canInviteUsers = $value;
        return $this;
    }

    public function getCanPostMessages(): ?bool {
        return $this->canPostMessages;
    }

    public function setCanPostMessages(?bool $value): self {
        $this->canPostMessages = $value;
        return $this;
    }

    public function getCanEditMessages(): ?bool {
        return $this->canEditMessages;
    }

    public function setCanEditMessages(?bool $value): self {
        $this->canEditMessages = $value;
        return $this;
    }

    public function getCanPinMessages(): ?bool {
        return $this->canPinMessages;
    }

    public function setCanPinMessages(?bool $value): self {
        $this->canPinMessages = $value;
        return $this;
    }

    public function getCanManageTopics(): ?bool {
        return $this->canManageTopics;
    }

    public function setCanManageTopics(?bool $value): self {
        $this->canManageTopics = $value;
        return $this;
    }

    public function getCustomTitle(): ?string {
        return $this->customTitle;
    }

    public function setCustomTitle(?string $value): self {
        $this->customTitle = $value;
        return $this;
    }

}
