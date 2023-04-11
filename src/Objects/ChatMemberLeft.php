<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatMemberLeft {

    use ObjectTrait;

    /**
     * Status
     *
     * The member's status in the chat, always “left”
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

    public function __construct(
        ?string $status = null,
        ?User   $user = null,
    ) {
        $this->status = $status;
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

}
