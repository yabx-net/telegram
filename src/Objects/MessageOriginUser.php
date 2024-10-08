<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MessageOriginUser extends MessageOrigin {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the message origin, always “user”
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
        ?string $type = null,
        ?int    $date = null,
        ?User   $senderUser = null,
    ) {
        $this->type = $type;
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