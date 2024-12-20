<?php

namespace Yabx\Telegram\Objects;

final class MessageOriginHiddenUser extends MessageOrigin {

    /**
     * Type
     *
     * Type of the message origin, always “hidden_user”
     * @var string
     */
    protected string $type = 'hidden_user';

    /**
     * Date
     *
     * Date the message was sent originally in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Sender User Name
     *
     * Name of the user that sent the message originally
     * @var string|null
     */
    protected ?string $senderUserName = null;

    public static function fromArray(array $data): MessageOriginHiddenUser {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['sender_user_name'])) {
            $instance->senderUserName = $data['sender_user_name'];
        }
        return $instance;
    }

    public function __construct(
        ?int    $date = null,
        ?string $senderUserName = null,
    ) {
        $this->date = $date;
        $this->senderUserName = $senderUserName;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getSenderUserName(): ?string {
        return $this->senderUserName;
    }

    public function setSenderUserName(?string $value): self {
        $this->senderUserName = $value;
        return $this;
    }

}
