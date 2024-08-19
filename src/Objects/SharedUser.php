<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class SharedUser {

    use ObjectTrait;

    /**
     * User Id
     *
     * Identifier of the shared user. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so 64-bit integers or double-precision float types are safe for storing these identifiers. The bot may not have access to the user and could be unable to use this identifier, unless the user is already known to the bot by some other means.
     * @var int|null
     */
    protected ?int $userId = null;

    /**
     * First Name
     *
     * Optional. First name of the user, if the name was requested by the bot
     * @var string|null
     */
    protected ?string $firstName = null;

    /**
     * Last Name
     *
     * Optional. Last name of the user, if the name was requested by the bot
     * @var string|null
     */
    protected ?string $lastName = null;

    /**
     * Username
     *
     * Optional. Username of the user, if the username was requested by the bot
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * Photo
     *
     * Optional. Available sizes of the chat photo, if the photo was requested by the bot
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    public static function fromArray(array $data): SharedUser {
        $instance = new self();
        if (isset($data['user_id'])) {
            $instance->userId = $data['user_id'];
        }
        if (isset($data['first_name'])) {
            $instance->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $instance->lastName = $data['last_name'];
        }
        if (isset($data['username'])) {
            $instance->username = $data['username'];
        }
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?int    $userId = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $username = null,
        ?array  $photo = null,
    ) {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->photo = $photo;
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $value): self {
        $this->userId = $value;
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

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $value): self {
        $this->username = $value;
        return $this;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

}
