<?php

namespace Yabx\Telegram\Objects;

class MessageAutoDeleteTimerChanged {

    /**
     * Message Auto Delete Time
     *
     * New auto-delete time for messages in the chat; in seconds
     * @var int
     */
    protected int $messageAutoDeleteTime;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['message_auto_delete_time'])) {
            $this->messageAutoDeleteTime = $data['message_auto_delete_time'];
        }
    }

    public function getMessageAutoDeleteTime(): int {
        return $this->messageAutoDeleteTime;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
