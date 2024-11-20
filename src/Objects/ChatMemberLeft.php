<?php

namespace Yabx\Telegram\Objects;

final class ChatMemberLeft extends ChatMember {

    /**
     * Status
     *
     * The member's status in the chat, always “left”
     * @var string
     */
    protected string $status = 'left';

    /**
     * User
     *
     * Information about the user
     * @var User|null
     */
    protected ?User $user = null;

    public function __construct(
        ?User   $user = null,
    ) {
        $this->user = $user;
    }

    public static function fromArray(array $data): ChatMemberLeft {
        $instance = new self();
        if (isset($data['status'])) {
            $instance->status = $data['status'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        return $instance;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

}
