<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Chat {

    use ObjectTrait;

    /**
     * Id
     *
     * Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Type
     *
     * Type of the chat, can be either “private”, “group”, “supergroup” or “channel”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Title
     *
     * Optional. Title, for supergroups, channels and group chats
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Username
     *
     * Optional. Username, for private chats, supergroups and channels if available
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * First Name
     *
     * Optional. First name of the other party in a private chat
     * @var string|null
     */
    protected ?string $firstName = null;

    /**
     * Last Name
     *
     * Optional. Last name of the other party in a private chat
     * @var string|null
     */
    protected ?string $lastName = null;

    /**
     * Is Forum
     *
     * Optional. True, if the supergroup chat is a forum (has topics enabled)
     * @var bool|null
     */
    protected ?bool $isForum = null;

    public static function fromArray(array $data): Chat {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['username'])) {
            $instance->username = $data['username'];
        }
        if (isset($data['first_name'])) {
            $instance->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $instance->lastName = $data['last_name'];
        }
        if (isset($data['is_forum'])) {
            $instance->isForum = $data['is_forum'];
        }
        return $instance;
    }

    public function __construct(
        ?int    $id = null,
        ?string $type = null,
        ?string $title = null,
        ?string $username = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?bool   $isForum = null,
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->isForum = $isForum;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $value): self {
        $this->id = $value;
        return $this;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $value): self {
        $this->username = $value;
        return $this;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(?string $value): self {
        $this->firstName = $value;
        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(?string $value): self {
        $this->lastName = $value;
        return $this;
    }

    public function getIsForum(): ?bool {
        return $this->isForum;
    }

    public function setIsForum(?bool $value): self {
        $this->isForum = $value;
        return $this;
    }

}
