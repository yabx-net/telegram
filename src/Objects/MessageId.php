<?php

namespace Yabx\Telegram\Objects;

final class MessageId extends AbstractObject {

    /**
     * Message Id
     *
     * Unique message identifier
     * @var int|null
     */
    protected ?int $messageId = null;

    public function __construct(
        ?int $messageId = null,
    ) {
        $this->messageId = $messageId;
    }

    public static function fromArray(array $data): MessageId {
        $instance = new self();
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        return $instance;
    }

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

}
