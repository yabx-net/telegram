<?php

namespace Yabx\Telegram\Objects;

final class MessageAutoDeleteTimerChanged extends AbstractObject {

    /**
     * Message Auto Delete Time
     *
     * New auto-delete time for messages in the chat; in seconds
     * @var int|null
     */
    protected ?int $messageAutoDeleteTime = null;

    public static function fromArray(array $data): MessageAutoDeleteTimerChanged {
        $instance = new self();
        if (isset($data['message_auto_delete_time'])) {
            $instance->messageAutoDeleteTime = $data['message_auto_delete_time'];
        }
        return $instance;
    }

    public function __construct(
        ?int $messageAutoDeleteTime = null,
    ) {
        $this->messageAutoDeleteTime = $messageAutoDeleteTime;
    }

    public function getMessageAutoDeleteTime(): ?int {
        return $this->messageAutoDeleteTime;
    }

    public function setMessageAutoDeleteTime(?int $value): self {
        $this->messageAutoDeleteTime = $value;
        return $this;
    }

}
