<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class UserShared {

    use ObjectTrait;

    /**
     * Request Id
     *
     * Identifier of the request
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * User Id
     *
     * Identifier of the shared user. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the user and could be unable to use this identifier, unless the user is already known to the bot by some other means.
     * @var int|null
     */
    protected ?int $userId = null;

    public function __construct(
        ?int $requestId = null,
        ?int $userId = null,
    ) {
        $this->requestId = $requestId;
        $this->userId = $userId;
    }

    public static function fromArray(array $data): UserShared {
        $instance = new self();
        if (isset($data['request_id'])) {
            $instance->requestId = $data['request_id'];
        }
        if (isset($data['user_id'])) {
            $instance->userId = $data['user_id'];
        }
        return $instance;
    }

    public function getRequestId(): ?int {
        return $this->requestId;
    }

    public function setRequestId(?int $value): self {
        $this->requestId = $value;
        return $this;
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $value): self {
        $this->userId = $value;
        return $this;
    }

}
