<?php

namespace Yabx\Telegram\Objects;

final class InaccessibleMessage extends AbstractObject {

    /**
     * Chat
     *
     * Chat the message belonged to
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Message Id
     *
     * Unique message identifier inside the chat
     * @var int|null
     */
    protected ?int $messageId = null;

    /**
     * Date
     *
     * Always 0. The field can be used to differentiate regular and inaccessible messages.
     * @var int|null
     */
    protected ?int $date = null;

    public function __construct(
        ?Chat $chat = null,
        ?int  $messageId = null,
        ?int  $date = null,
    ) {
        $this->chat = $chat;
        $this->messageId = $messageId;
        $this->date = $date;
    }

    public static function fromArray(array $data): InaccessibleMessage {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
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

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

}
