<?php

namespace Yabx\Telegram\Objects;

final class ChatMemberMember extends ChatMember {

    /**
     * Status
     *
     * The member's status in the chat, always “member”
     * @var string
     */
    protected string $status = 'member';

    /**
     * User
     *
     * Information about the user
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Until Date
     *
     * Optional. Date when the user's subscription will expire; Unix time
     * @var int|null
     */
    protected ?int $untilDate = null;

    public function __construct(
        ?User   $user = null,
        ?int    $untilDate = null,
    ) {
        $this->user = $user;
        $this->untilDate = $untilDate;
    }

    public static function fromArray(array $data): ChatMemberMember {
        $instance = new self();
        if (isset($data['status'])) {
            $instance->status = $data['status'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['until_date'])) {
            $instance->untilDate = $data['until_date'];
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

    public function getUntilDate(): ?int {
        return $this->untilDate;
    }

    public function setUntilDate(?int $value): self {
        $this->untilDate = $value;
        return $this;
    }

}
