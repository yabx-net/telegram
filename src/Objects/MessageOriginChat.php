<?php

namespace Yabx\Telegram\Objects;

final class MessageOriginChat extends MessageOrigin {

    /**
     * Type
     *
     * Type of the message origin, always “chat”
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
     * Sender Chat
     *
     * Chat that sent the message originally
     * @var Chat|null
     */
    protected ?Chat $senderChat = null;

    /**
     * Author Signature
     *
     * Optional. For messages originally sent by an anonymous chat administrator, original message author signature
     * @var string|null
     */
    protected ?string $authorSignature = null;

    public static function fromArray(array $data): MessageOriginChat {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['sender_chat'])) {
            $instance->senderChat = Chat::fromArray($data['sender_chat']);
        }
        if (isset($data['author_signature'])) {
            $instance->authorSignature = $data['author_signature'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?int    $date = null,
        ?Chat   $senderChat = null,
        ?string $authorSignature = null,
    ) {
        $this->type = $type;
        $this->date = $date;
        $this->senderChat = $senderChat;
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

    public function getSenderChat(): ?Chat {
        return $this->senderChat;
    }

    public function setSenderChat(?Chat $value): self {
        $this->senderChat = $value;
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
