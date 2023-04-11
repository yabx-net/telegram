<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatShared {

    use ObjectTrait;

    /**
     * Request Id
     *
     * Identifier of the request
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * Chat Id
     *
     * Identifier of the shared chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the chat and could be unable to use this identifier, unless the chat is already known to the bot by some other means.
     * @var int|null
     */
    protected ?int $chatId = null;

    public function __construct(
        ?int $requestId = null,
        ?int $chatId = null,
    ) {
        $this->requestId = $requestId;
        $this->chatId = $chatId;
    }

    public static function fromArray(array $data): ChatShared {
        $instance = new self();
        if (isset($data['request_id'])) {
            $instance->requestId = $data['request_id'];
        }
        if (isset($data['chat_id'])) {
            $instance->chatId = $data['chat_id'];
        }
        return $instance;
    }

    public function getRequestId(): ?int {
        return $this->requestId;
    }

    public function setRequestId(?int $value): self {
        $this->requestId = $value;
        return $this;
    }

    public function getChatId(): ?int {
        return $this->chatId;
    }

    public function setChatId(?int $value): self {
        $this->chatId = $value;
        return $this;
    }

}
