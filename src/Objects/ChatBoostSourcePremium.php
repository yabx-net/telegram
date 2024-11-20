<?php

namespace Yabx\Telegram\Objects;

final class ChatBoostSourcePremium extends AbstractObject {

    /**
     * Source
     *
     * Source of the boost, always “premium”
     * @var string
     */
    protected string $source = 'premium';

    /**
     * User
     *
     * User that boosted the chat
     * @var User|null
     */
    protected ?User $user = null;

    public function __construct(
        ?User   $user = null,
    ) {
        $this->user = $user;
    }

    public static function fromArray(array $data): ChatBoostSourcePremium {
        $instance = new self();
        if (isset($data['source'])) {
            $instance->source = $data['source'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        return $instance;
    }

    public function getSource(): string {
        return $this->source;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

}
