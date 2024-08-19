<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MessageId {

    use ObjectTrait;

    /**
     * Message Id
     *
     * Unique message identifier
     * @var int|null
     */
    protected ?int $messageId = null;

    public static function fromArray(array $data): MessageId {
        $instance = new self();
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        return $instance;
    }

    public function __construct(
        ?int $messageId = null,
    ) {
        $this->messageId = $messageId;
    }

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

}
