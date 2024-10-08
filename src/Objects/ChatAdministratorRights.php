<?php

namespace Yabx\Telegram\Objects;

final class ChatAdministratorRights extends AbstractObject {

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
     * True, if the administrator can access the chat event log, get boost list, see hidden supergroup and channel members, report spam messages and ignore slow mode. Implied by any other administrator privilege.
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
     * True, if the administrator can restrict, ban or unban chat members, or access supergroup statistics
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
     * Can Post Stories
     *
     * True, if the administrator can post stories to the chat
     * @var bool|null
     */
    protected ?bool $canPostStories = null;

    /**
     * Can Edit Stories
     *
     * True, if the administrator can edit stories posted by other users, post stories to the chat page, pin chat stories, and access the chat's story archive
     * @var bool|null
     */
    protected ?bool $canEditStories = null;

    /**
     * Can Delete Stories
     *
     * True, if the administrator can delete stories posted by other users
     * @var bool|null
     */
    protected ?bool $canDeleteStories = null;

    /**
     * Can Post Messages
     *
     * Optional. True, if the administrator can post messages in the channel, or access channel statistics; for channels only
     * @var bool|null
     */
    protected ?bool $canPostMessages = null;

    /**
     * Can Edit Messages
     *
     * Optional. True, if the administrator can edit messages of other users and can pin messages; for channels only
     * @var bool|null
     */
    protected ?bool $canEditMessages = null;

    /**
     * Can Pin Messages
     *
     * Optional. True, if the user is allowed to pin messages; for groups and supergroups only
     * @var bool|null
     */
    protected ?bool $canPinMessages = null;

    /**
     * Can Manage Topics
     *
     * Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; for supergroups only
     * @var bool|null
     */
    protected ?bool $canManageTopics = null;

    public function __construct(
        ?bool $isAnonymous = null,
        ?bool $canManageChat = null,
        ?bool $canDeleteMessages = null,
        ?bool $canManageVideoChats = null,
        ?bool $canRestrictMembers = null,
        ?bool $canPromoteMembers = null,
        ?bool $canChangeInfo = null,
        ?bool $canInviteUsers = null,
        ?bool $canPostStories = null,
        ?bool $canEditStories = null,
        ?bool $canDeleteStories = null,
        ?bool $canPostMessages = null,
        ?bool $canEditMessages = null,
        ?bool $canPinMessages = null,
        ?bool $canManageTopics = null,
    ) {
        $this->isAnonymous = $isAnonymous;
        $this->canManageChat = $canManageChat;
        $this->canDeleteMessages = $canDeleteMessages;
        $this->canManageVideoChats = $canManageVideoChats;
        $this->canRestrictMembers = $canRestrictMembers;
        $this->canPromoteMembers = $canPromoteMembers;
        $this->canChangeInfo = $canChangeInfo;
        $this->canInviteUsers = $canInviteUsers;
        $this->canPostStories = $canPostStories;
        $this->canEditStories = $canEditStories;
        $this->canDeleteStories = $canDeleteStories;
        $this->canPostMessages = $canPostMessages;
        $this->canEditMessages = $canEditMessages;
        $this->canPinMessages = $canPinMessages;
        $this->canManageTopics = $canManageTopics;
    }

    public static function fromArray(array $data): ChatAdministratorRights {
        $instance = new self();
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
        if (isset($data['can_post_stories'])) {
            $instance->canPostStories = $data['can_post_stories'];
        }
        if (isset($data['can_edit_stories'])) {
            $instance->canEditStories = $data['can_edit_stories'];
        }
        if (isset($data['can_delete_stories'])) {
            $instance->canDeleteStories = $data['can_delete_stories'];
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
        return $instance;
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

    public function getCanPostStories(): ?bool {
        return $this->canPostStories;
    }

    public function setCanPostStories(?bool $value): self {
        $this->canPostStories = $value;
        return $this;
    }

    public function getCanEditStories(): ?bool {
        return $this->canEditStories;
    }

    public function setCanEditStories(?bool $value): self {
        $this->canEditStories = $value;
        return $this;
    }

    public function getCanDeleteStories(): ?bool {
        return $this->canDeleteStories;
    }

    public function setCanDeleteStories(?bool $value): self {
        $this->canDeleteStories = $value;
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

}
