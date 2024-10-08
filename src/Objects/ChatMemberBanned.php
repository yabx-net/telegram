<?php

namespace Yabx\Telegram\Objects;

final class ChatMemberBanned extends ChatMember {

    /**
     * Status
     *
     * The member's status in the chat, always “kicked”
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
     * Until Date
     *
     * Date when restrictions will be lifted for this user; Unix time. If 0, then the user is banned forever
     * @var int|null
     */
    protected ?int $untilDate = null;

    public function __construct(
        ?string $status = null,
        ?User   $user = null,
        ?int    $untilDate = null,
    ) {
        $this->status = $status;
        $this->user = $user;
        $this->untilDate = $untilDate;
    }

    public static function fromArray(array $data): ChatMemberBanned {
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

    public function getUntilDate(): ?int {
        return $this->untilDate;
    }

    public function setUntilDate(?int $value): self {
        $this->untilDate = $value;
        return $this;
    }

}
