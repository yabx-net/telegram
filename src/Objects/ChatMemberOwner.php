<?php

namespace Yabx\Telegram\Objects;

final class ChatMemberOwner extends ChatMember {

    /**
     * Status
     *
     * The member's status in the chat, always “creator”
     * @var string
     */
    protected string $status = 'creator';

    /**
     * User
     *
     * Information about the user
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Is Anonymous
     *
     * True, if the user's presence in the chat is hidden
     * @var bool|null
     */
    protected ?bool $isAnonymous = null;

    /**
     * Custom Title
     *
     * Optional. Custom title for this user
     * @var string|null
     */
    protected ?string $customTitle = null;

    public function __construct(
        ?User   $user = null,
        ?bool   $isAnonymous = null,
        ?string $customTitle = null,
    ) {
        $this->user = $user;
        $this->isAnonymous = $isAnonymous;
        $this->customTitle = $customTitle;
    }

    public static function fromArray(array $data): ChatMemberOwner {
        $instance = new self();
        if (isset($data['status'])) {
            $instance->status = $data['status'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['is_anonymous'])) {
            $instance->isAnonymous = $data['is_anonymous'];
        }
        if (isset($data['custom_title'])) {
            $instance->customTitle = $data['custom_title'];
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

    public function getIsAnonymous(): ?bool {
        return $this->isAnonymous;
    }

    public function setIsAnonymous(?bool $value): self {
        $this->isAnonymous = $value;
        return $this;
    }

    public function getCustomTitle(): ?string {
        return $this->customTitle;
    }

    public function setCustomTitle(?string $value): self {
        $this->customTitle = $value;
        return $this;
    }

}
