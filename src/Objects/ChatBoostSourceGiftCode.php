<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatBoostSourceGiftCode {

    use ObjectTrait;

    /**
     * Source
     *
     * Source of the boost, always “gift_code”
     * @var string|null
     */
    protected ?string $source = null;

    /**
     * User
     *
     * User for which the gift code was created
     * @var User|null
     */
    protected ?User $user = null;

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

    public function __construct(
        ?string $source = null,
        ?User   $user = null,
    ) {
        $this->source = $source;
        $this->user = $user;
    }

    public function getSource(): ?string {
        return $this->source;
    }

    public function setSource(?string $value): self {
        $this->source = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

}
