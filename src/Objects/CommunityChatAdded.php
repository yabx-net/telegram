<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a chat being added to a community.
 * @link https://core.telegram.org/bots/api#communitychatadded
 */
final class CommunityChatAdded extends AbstractObject {

    /**
     * Community
     *
     * The new community to which the chat belongs
     * @var Community|null
     */
    protected ?Community $community = null;

    public function __construct(
        ?Community $community = null
    ) {
        $this->community = $community;
    }

    public static function fromArray(array $data): CommunityChatAdded {
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
