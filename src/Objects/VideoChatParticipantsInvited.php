<?php

namespace Yabx\Telegram\Objects;

class VideoChatParticipantsInvited {

    /**
     * Users
     *
     * New members that were invited to the video chat
     * @var User[]
     */
    protected array $users;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['users'])) {
            $this->users = [];
            foreach ($data['users'] as $item) {
                $this->users[] = new User($item);
            }
        }
    }

    public function getUsers(): array {
        return $this->users;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
