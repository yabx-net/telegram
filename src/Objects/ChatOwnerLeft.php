<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about the chat owner leaving the chat.
 * @link https://core.telegram.org/bots/api#chatownerleft
 */
final class ChatOwnerLeft extends AbstractObject {

    /**
     * New Owner
     *
     * Optional. The user which will be the new owner of the chat if the previous owner does not return to the chat
     * @var User|null
     */
    protected ?User $newOwner = null;

    public static function fromArray(array $data): ChatOwnerLeft {
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
