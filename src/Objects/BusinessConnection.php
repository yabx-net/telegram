<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BusinessConnection {

    use ObjectTrait;

    /**
     * Id
     *
     * Unique identifier of the business connection
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * User
     *
     * Business account user that created the business connection
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * User Chat Id
     *
     * Identifier of a private chat with the user who created the business connection. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $userChatId = null;

    /**
     * Date
     *
     * Date the connection was established in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Can Reply
     *
     * True, if the bot can act on behalf of the business account in chats that were active in the last 24 hours
     * @var bool|null
     */
    protected ?bool $canReply = null;

    /**
     * Is Enabled
     *
     * True, if the connection is active
     * @var bool|null
     */
    protected ?bool $isEnabled = null;

    public static function fromArray(array $data): BusinessConnection {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['user_chat_id'])) {
            $instance->userChatId = $data['user_chat_id'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['can_reply'])) {
            $instance->canReply = $data['can_reply'];
        }
        if (isset($data['is_enabled'])) {
            $instance->isEnabled = $data['is_enabled'];
        }
        return $instance;
    }

    public function __construct(
        ?string $id = null,
        ?User   $user = null,
        ?int    $userChatId = null,
        ?int    $date = null,
        ?bool   $canReply = null,
        ?bool   $isEnabled = null,
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->userChatId = $userChatId;
        $this->date = $date;
        $this->canReply = $canReply;
        $this->isEnabled = $isEnabled;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
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

    public function getCanReply(): ?bool {
        return $this->canReply;
    }

    public function setCanReply(?bool $value): self {
        $this->canReply = $value;
        return $this;
    }

    public function getIsEnabled(): ?bool {
        return $this->isEnabled;
    }

    public function setIsEnabled(?bool $value): self {
        $this->isEnabled = $value;
        return $this;
    }

}
