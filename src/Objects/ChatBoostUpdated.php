<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatBoostUpdated {

    use ObjectTrait;

    /**
     * Chat
     *
     * Chat which was boosted
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Boost
     *
     * Information about the chat boost
     * @var ChatBoost|null
     */
    protected ?ChatBoost $boost = null;

    public function __construct(
        ?Chat      $chat = null,
        ?ChatBoost $boost = null,
    ) {
        $this->chat = $chat;
        $this->boost = $boost;
    }

    public static function fromArray(array $data): ChatBoostUpdated {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['boost'])) {
            $instance->boost = ChatBoost::fromArray($data['boost']);
        }
        return $instance;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getBoost(): ?ChatBoost {
        return $this->boost;
    }

    public function setBoost(?ChatBoost $value): self {
        $this->boost = $value;
        return $this;
    }

}
