<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatBoostSourceGiveaway {

    use ObjectTrait;

    /**
     * Source
     *
     * Source of the boost, always “giveaway”
     * @var string|null
     */
    protected ?string $source = null;

    /**
     * Giveaway Message Id
     *
     * Identifier of a message in the chat with the giveaway; the message could have been deleted already. May be 0 if the message isn't sent yet.
     * @var int|null
     */
    protected ?int $giveawayMessageId = null;

    /**
     * User
     *
     * Optional. User that won the prize in the giveaway if any
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Is Unclaimed
     *
     * Optional. True, if the giveaway was completed, but there was no user to win the prize
     * @var bool|null
     */
    protected ?bool $isUnclaimed = null;

    public function __construct(
        ?string $source = null,
        ?int    $giveawayMessageId = null,
        ?User   $user = null,
        ?bool   $isUnclaimed = null,
    ) {
        $this->source = $source;
        $this->giveawayMessageId = $giveawayMessageId;
        $this->user = $user;
        $this->isUnclaimed = $isUnclaimed;
    }

    public static function fromArray(array $data): ChatBoostSourceGiveaway {
        $instance = new self();
        if (isset($data['source'])) {
            $instance->source = $data['source'];
        }
        if (isset($data['giveaway_message_id'])) {
            $instance->giveawayMessageId = $data['giveaway_message_id'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['is_unclaimed'])) {
            $instance->isUnclaimed = $data['is_unclaimed'];
        }
        return $instance;
    }

    public function getSource(): ?string {
        return $this->source;
    }

    public function setSource(?string $value): self {
        $this->source = $value;
        return $this;
    }

    public function getGiveawayMessageId(): ?int {
        return $this->giveawayMessageId;
    }

    public function setGiveawayMessageId(?int $value): self {
        $this->giveawayMessageId = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getIsUnclaimed(): ?bool {
        return $this->isUnclaimed;
    }

    public function setIsUnclaimed(?bool $value): self {
        $this->isUnclaimed = $value;
        return $this;
    }

}
