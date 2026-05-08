<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about an ownership change in the chat.
 * @link https://core.telegram.org/bots/api#chatownerchanged
 */
final class ChatOwnerChanged extends AbstractObject {

    /**
     * New Owner
     *
     * The new owner of the chat
     * @var User|null
     */
    protected ?User $newOwner = null;

    public static function fromArray(array $data): ChatOwnerChanged {
        $instance = new self();
        if (isset($data['new_owner'])) {
            $instance->newOwner = User::fromArray($data['new_owner']);
        }
        return $instance;
    }

    public function __construct(
        ?User $newOwner = null,
    ) {
        $this->newOwner = $newOwner;
    }

    public function getNewOwner(): ?User {
        return $this->newOwner;
    }

    public function setNewOwner(?User $value): self {
        $this->newOwner = $value;
        return $this;
    }

}
