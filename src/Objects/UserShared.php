<?php

namespace Yabx\Telegram\Objects;

class UserShared {

    /**
     * Request Id
     *
     * Identifier of the request
     * @var int
     */
    protected int $requestId;

    /**
     * User Id
     *
     * Identifier of the shared user. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the user and could be unable to use this identifier, unless the user is already known to the bot by some other means.
     * @var int
     */
    protected int $userId;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['request_id'])) {
            $this->requestId = $data['request_id'];
        }
        if (isset($data['user_id'])) {
            $this->userId = $data['user_id'];
        }
    }

    public function getRequestId(): int {
        return $this->requestId;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
