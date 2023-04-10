<?php

namespace Yabx\Telegram\Objects;

class ChatMemberLeft {

    /**
     * Status
     *
     * The member's status in the chat, always “left”
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


    public function __construct(array $data) {
        if (isset($data['status'])) {
            $this->status = $data['status'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getUser(): User {
        return $this->user;
    }


}
