<?php

namespace Yabx\Telegram\Objects;

final class ChatBoostSourceGiftCode extends ChatBoostSource {

    /**
     * Source
     *
     * Source of the boost, always “gift_code”
     */
    protected string $source = 'gift_code';

    /**
     * User
     *
     * User for which the gift code was created
     * @var User|null
     */
    protected ?User $user = null;

    public function __construct(
        ?User   $user = null,
    ) {
        $this->user = $user;
    }

    public static function fromArray(array $data): ChatBoostSourceGiftCode {
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
