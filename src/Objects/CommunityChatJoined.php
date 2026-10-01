<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a chat being joined by a user from a community.
 * @link https://core.telegram.org/bots/api#communitychatjoined
 */
final class CommunityChatJoined extends AbstractObject {

    /**
     * Community
     *
     * The community from which the chat was joined
     * @var Community|null
     */
    protected ?Community $community = null;

    public function __construct(
        ?Community $community = null,
    ) {
        $this->community = $community;
    }

    public static function fromArray(array $data): CommunityChatJoined {
        $instance = new self();
        if (isset($data['community'])) {
            $instance->community = Community::fromArray($data['community']);
        }
        return $instance;
    }

    public function getCommunity(): ?Community {
        return $this->community;
    }

    public function setCommunity(?Community $value): self {
        $this->community = $value;
        return $this;
    }
}
