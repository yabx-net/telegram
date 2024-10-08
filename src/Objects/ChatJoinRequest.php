<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatJoinRequest {

    use ObjectTrait;

    /**
     * Chat
     *
     * Chat to which the request was sent
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * From
     *
     * User that sent the join request
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * User Chat Id
     *
     * Identifier of a private chat with the user who sent the join request. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot can use this identifier for 5 minutes to send messages until the join request is processed, assuming no other administrator contacted the user.
     * @var int|null
     */
    protected ?int $userChatId = null;

    /**
     * Date
     *
     * Date the request was sent in Unix time
     * @var int|null
     */
    protected ?int $date = null;

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

    public function __construct(
        ?Chat           $chat = null,
        ?User           $from = null,
        ?int            $userChatId = null,
        ?int            $date = null,
        ?string         $bio = null,
        ?ChatInviteLink $inviteLink = null,
    ) {
        $this->chat = $chat;
        $this->from = $from;
        $this->userChatId = $userChatId;
        $this->date = $date;
        $this->bio = $bio;
        $this->inviteLink = $inviteLink;
    }

    public static function fromArray(array $data): ChatJoinRequest {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['user_chat_id'])) {
            $instance->userChatId = $data['user_chat_id'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['bio'])) {
            $instance->bio = $data['bio'];
        }
        if (isset($data['invite_link'])) {
            $instance->inviteLink = ChatInviteLink::fromArray($data['invite_link']);
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

    public function getUserChatId(): ?int {
        return $this->userChatId;
    }

    public function setUserChatId(?int $value): self {
        $this->userChatId = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getBio(): ?string {
        return $this->bio;
    }

    public function setBio(?string $value): self {
        $this->bio = $value;
        return $this;
    }

    public function getInviteLink(): ?ChatInviteLink {
        return $this->inviteLink;
    }

    public function setInviteLink(?ChatInviteLink $value): self {
        $this->inviteLink = $value;
        return $this;
    }

}
