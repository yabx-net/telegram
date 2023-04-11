<?php

namespace Yabx\Telegram\Objects;

class ChatMemberBanned {

    /**
     * Status
     *
     * The member's status in the chat, always “kicked”
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
     * Until Date
     *
     * Date when restrictions will be lifted for this user; unix time. If 0, then the user is banned forever
     * @var int
     */
    protected int $untilDate;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['status'])) {
            $this->status = $data['status'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (isset($data['until_date'])) {
            $this->untilDate = $data['until_date'];
        }
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getUntilDate(): int {
        return $this->untilDate;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
