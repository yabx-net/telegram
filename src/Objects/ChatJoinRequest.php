<?php

namespace Yabx\Telegram\Objects;

class ChatJoinRequest {

    /**
     * Chat
     *
     * Chat to which the request was sent
     * @var Chat
     */
    protected Chat $chat;

    /**
     * From
     *
     * User that sent the join request
     * @var User
     */
    protected User $from;

    /**
     * User Chat Id
     *
     * Identifier of a private chat with the user who sent the join request. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot can use this identifier for 24 hours to send messages until the join request is processed, assuming no other administrator contacted the user.
     * @var int
     */
    protected int $userChatId;

    /**
     * Date
     *
     * Date the request was sent in Unix time
     * @var int
     */
    protected int $date;

    /**
     * Bio
     *
     * Optional. Bio of the user.
     * @var string|null
     */
    protected ?string $bio = null;

    /**
     * Invite Link
     *
     * Optional. Chat invite link that was used by the user to send the join request
     * @var ChatInviteLink|null
     */
    protected ?ChatInviteLink $inviteLink = null;


    public function __construct(array $data) {
        if (isset($data['chat'])) {
            $this->chat = new Chat($data['chat']);
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['user_chat_id'])) {
            $this->userChatId = $data['user_chat_id'];
        }
        if (isset($data['date'])) {
            $this->date = $data['date'];
        }
        if (isset($data['bio'])) {
            $this->bio = $data['bio'];
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

    public function getUserChatId(): int {
        return $this->userChatId;
    }

    public function getDate(): int {
        return $this->date;
    }

    public function getBio(): ?string {
        return $this->bio;
    }

    public function getInviteLink(): ?ChatInviteLink {
        return $this->inviteLink;
    }


}
