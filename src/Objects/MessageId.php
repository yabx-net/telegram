<?php

namespace Yabx\Telegram\Objects;

class MessageId {

    /**
     * Message Id
     *
     * Unique message identifier
     * @var int
     */
    protected int $messageId;


    public function __construct(array $data) {
        if (isset($data['message_id'])) {
            $this->messageId = $data['message_id'];
        }
    }

    public function getMessageId(): int {
        return $this->messageId;
    }


}
