<?php

namespace Yabx\Telegram\Objects;

final class MessageOriginUser extends MessageOrigin {

    /**
     * Type
     *
     * Type of the message origin, always “user”
     * @var string
     */
    protected string $type = 'user';

    /**
     * Date
     *
     * Date the message was sent originally in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Sender User
     *
     * User that sent the message originally
     * @var User|null
     */
    protected ?User $senderUser = null;

    public static function fromArray(array $data): MessageOriginUser {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['sender_user'])) {
            $instance->senderUser = User::fromArray($data['sender_user']);
        }
        return $instance;
    }

    public function __construct(
        ?int    $date = null,
        ?User   $senderUser = null,
    ) {
        $this->date = $date;
        $this->senderUser = $senderUser;
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

    public function getSenderUser(): ?User {
        return $this->senderUser;
    }

    public function setSenderUser(?User $value): self {
        $this->senderUser = $value;
        return $this;
    }

}
