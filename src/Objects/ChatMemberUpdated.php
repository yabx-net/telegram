<?php

namespace Yabx\Telegram\Objects;

class ChatMemberUpdated {

    /**
     * Chat
     *
     * Chat the user belongs to
     * @var Chat
     */
    protected Chat $chat;

    /**
     * From
     *
     * Performer of the action, which resulted in the change
     * @var User
     */
    protected User $from;

    /**
     * Date
     *
     * Date the change was done in Unix time
     * @var int
     */
    protected int $date;

    /**
     * Old Chat Member
     *
     * Previous information about the chat member
     * @var ChatMember
     */
    protected ChatMember $oldChatMember;

    /**
     * New Chat Member
     *
     * New information about the chat member
     * @var ChatMember
     */
    protected ChatMember $newChatMember;

    /**
     * Invite Link
     *
     * Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
     * @var ChatInviteLink|null
     */
    protected ?ChatInviteLink $inviteLink = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['chat'])) {
            $this->chat = new Chat($data['chat']);
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['date'])) {
            $this->date = $data['date'];
        }
        if (isset($data['old_chat_member'])) {
            $this->oldChatMember = new ChatMember($data['old_chat_member']);
        }
        if (isset($data['new_chat_member'])) {
            $this->newChatMember = new ChatMember($data['new_chat_member']);
        }
        if (isset($data['invite_link'])) {
            $this->inviteLink = new ChatInviteLink($data['invite_link']);
        }
    }

    public function getChat(): Chat {
        return $this->chat;
    }

    public function getFrom(): User {
        return $this->from;
    }

    public function getDate(): int {
        return $this->date;
    }

    public function getOldChatMember(): ChatMember {
        return $this->oldChatMember;
    }

    public function getNewChatMember(): ChatMember {
        return $this->newChatMember;
    }

    public function getInviteLink(): ?ChatInviteLink {
        return $this->inviteLink;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
