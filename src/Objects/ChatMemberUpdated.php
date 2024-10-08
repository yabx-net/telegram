<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatMemberUpdated {

    use ObjectTrait;

    /**
     * Chat
     *
     * Chat the user belongs to
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * From
     *
     * Performer of the action, which resulted in the change
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Date
     *
     * Date the change was done in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Old Chat Member
     *
     * Previous information about the chat member
     * @var ChatMember|null
     */
    protected ?ChatMember $oldChatMember = null;

    /**
     * New Chat Member
     *
     * New information about the chat member
     * @var ChatMember|null
     */
    protected ?ChatMember $newChatMember = null;

    /**
     * Invite Link
     *
     * Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
     * @var ChatInviteLink|null
     */
    protected ?ChatInviteLink $inviteLink = null;

    /**
     * Via Join Request
     *
     * Optional. True, if the user joined the chat after sending a direct join request without using an invite link and being approved by an administrator
     * @var bool|null
     */
    protected ?bool $viaJoinRequest = null;

    /**
     * Via Chat Folder Invite Link
     *
     * Optional. True, if the user joined the chat via a chat folder invite link
     * @var bool|null
     */
    protected ?bool $viaChatFolderInviteLink = null;

    public function __construct(
        ?Chat           $chat = null,
        ?User           $from = null,
        ?int            $date = null,
        ?ChatMember     $oldChatMember = null,
        ?ChatMember     $newChatMember = null,
        ?ChatInviteLink $inviteLink = null,
        ?bool           $viaJoinRequest = null,
        ?bool           $viaChatFolderInviteLink = null,
    ) {
        $this->chat = $chat;
        $this->from = $from;
        $this->date = $date;
        $this->oldChatMember = $oldChatMember;
        $this->newChatMember = $newChatMember;
        $this->inviteLink = $inviteLink;
        $this->viaJoinRequest = $viaJoinRequest;
        $this->viaChatFolderInviteLink = $viaChatFolderInviteLink;
    }

    public static function fromArray(array $data): ChatMemberUpdated {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['old_chat_member'])) {
            $instance->oldChatMember = ChatMember::fromArray($data['old_chat_member']);
        }
        if (isset($data['new_chat_member'])) {
            $instance->newChatMember = ChatMember::fromArray($data['new_chat_member']);
        }
        if (isset($data['invite_link'])) {
            $instance->inviteLink = ChatInviteLink::fromArray($data['invite_link']);
        }
        if (isset($data['via_join_request'])) {
            $instance->viaJoinRequest = $data['via_join_request'];
        }
        if (isset($data['via_chat_folder_invite_link'])) {
            $instance->viaChatFolderInviteLink = $data['via_chat_folder_invite_link'];
        }
        return $instance;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getOldChatMember(): ?ChatMember {
        return $this->oldChatMember;
    }

    public function setOldChatMember(?ChatMember $value): self {
        $this->oldChatMember = $value;
        return $this;
    }

    public function getNewChatMember(): ?ChatMember {
        return $this->newChatMember;
    }

    public function setNewChatMember(?ChatMember $value): self {
        $this->newChatMember = $value;
        return $this;
    }

    public function getInviteLink(): ?ChatInviteLink {
        return $this->inviteLink;
    }

    public function setInviteLink(?ChatInviteLink $value): self {
        $this->inviteLink = $value;
        return $this;
    }

    public function getViaJoinRequest(): ?bool {
        return $this->viaJoinRequest;
    }

    public function setViaJoinRequest(?bool $value): self {
        $this->viaJoinRequest = $value;
        return $this;
    }

    public function getViaChatFolderInviteLink(): ?bool {
        return $this->viaChatFolderInviteLink;
    }

    public function setViaChatFolderInviteLink(?bool $value): self {
        $this->viaChatFolderInviteLink = $value;
        return $this;
    }

}
