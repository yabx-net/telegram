<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class VideoChatParticipantsInvited {

    use ObjectTrait;

    /**
     * Users
     *
     * New members that were invited to the video chat
     * @var User[]|null
     */
    protected ?array $users = null;

    public function __construct(
        ?array $users = null,
    ) {
        $this->users = $users;
    }

    public static function fromArray(array $data): VideoChatParticipantsInvited {
        $instance = new self();
        if (isset($data['users'])) {
            $instance->users = [];
            foreach ($data['users'] as $item) {
                $instance->users[] = User::fromArray($item);
            }
        }
        return $instance;
    }

    public function getUsers(): ?array {
        return $this->users;
    }

    public function setUsers(?array $value): self {
        $this->users = $value;
        return $this;
    }

}
