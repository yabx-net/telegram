<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class UserChatBoosts {

    use ObjectTrait;

    /**
     * Boosts
     *
     * The list of boosts added to the chat by the user
     * @var ChatBoost[]|null
     */
    protected ?array $boosts = null;

    public function __construct(
        ?array $boosts = null,
    ) {
        $this->boosts = $boosts;
    }

    public static function fromArray(array $data): UserChatBoosts {
        $instance = new self();
        if (isset($data['boosts'])) {
            $instance->boosts = [];
            foreach ($data['boosts'] as $item) {
                $instance->boosts[] = ChatBoost::fromArray($item);
            }
        }
        return $instance;
    }

    public function getBoosts(): ?array {
        return $this->boosts;
    }

    public function setBoosts(?array $value): self {
        $this->boosts = $value;
        return $this;
    }

}
