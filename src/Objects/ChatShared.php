<?php

namespace Yabx\Telegram\Objects;

class ChatShared {

    /**
     * Request Id
     *
     * Identifier of the request
     * @var int
     */
    protected int $requestId;

    /**
     * Chat Id
     *
     * Identifier of the shared chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the chat and could be unable to use this identifier, unless the chat is already known to the bot by some other means.
     * @var int
     */
    protected int $chatId;


    public function __construct(array $data) {
        if (isset($data['request_id'])) {
            $this->requestId = $data['request_id'];
        }
        if (isset($data['chat_id'])) {
            $this->chatId = $data['chat_id'];
        }
    }

    public function getRequestId(): int {
        return $this->requestId;
    }

    public function getChatId(): int {
        return $this->chatId;
    }


}
