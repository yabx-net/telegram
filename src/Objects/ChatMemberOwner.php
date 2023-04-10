<?php

namespace Yabx\Telegram\Objects;

class ChatMemberOwner {

    /**
     * Status
     *
     * The member's status in the chat, always “creator”
     * @var string
     */
    protected string $status;

    /**
     * User
     *
     * Information about the user
     * @var User
     */
    protected User $user;

    /**
     * Is Anonymous
     *
     * True, if the user's presence in the chat is hidden
     * @var bool
     */
    protected bool $isAnonymous;

    /**
     * Custom Title
     *
     * Optional. Custom title for this user
     * @var string|null
     */
    protected ?string $customTitle = null;


    public function __construct(array $data) {
        if (isset($data['status'])) {
            $this->status = $data['status'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (isset($data['is_anonymous'])) {
            $this->isAnonymous = $data['is_anonymous'];
        }
        if (isset($data['custom_title'])) {
            $this->customTitle = $data['custom_title'];
        }
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getIsAnonymous(): bool {
        return $this->isAnonymous;
    }

    public function getCustomTitle(): ?string {
        return $this->customTitle;
    }


}
