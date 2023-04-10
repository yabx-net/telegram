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


    public function __construct(array $data) {
        if (isset($data['message_auto_delete_time'])) {
            $this->messageAutoDeleteTime = $data['message_auto_delete_time'];
        }
    }

    public function getMessageAutoDeleteTime(): int {
        return $this->messageAutoDeleteTime;
    }


}
