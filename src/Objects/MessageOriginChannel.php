<?php

namespace Yabx\Telegram\Objects;

final class MessageOriginChannel extends MessageOrigin {

    /**
     * Type
     *
     * Type of the message origin, always “channel”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Date
     *
     * Date the message was sent originally in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Chat
     *
     * Channel chat to which the message was originally sent
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
     * Author Signature
     *
     * Optional. Signature of the original post author
     * @var string|null
     */
    protected ?string $authorSignature = null;

    public static function fromArray(array $data): MessageOriginChannel {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['author_signature'])) {
            $instance->authorSignature = $data['author_signature'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?int    $date = null,
        ?Chat   $chat = null,
        ?int    $messageId = null,
        ?string $authorSignature = null,
    ) {
        $this->type = $type;
        $this->date = $date;
        $this->chat = $chat;
        $this->messageId = $messageId;
        $this->authorSignature = $authorSignature;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
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

    public function getAuthorSignature(): ?string {
        return $this->authorSignature;
    }

    public function setAuthorSignature(?string $value): self {
        $this->authorSignature = $value;
        return $this;
    }

}
