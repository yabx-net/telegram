<?php

namespace Yabx\Telegram\Objects;

class ResponseParameters {

    /**
     * Migrate To Chat Id
     *
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $migrateToChatId = null;

    /**
     * Retry After
     *
     * Optional. In case of exceeding flood control, the number of seconds left to wait before the request can be repeated
     * @var int|null
     */
    protected ?int $retryAfter = null;


    public function __construct(array $data) {
        if (isset($data['migrate_to_chat_id'])) {
            $this->migrateToChatId = $data['migrate_to_chat_id'];
        }
        if (isset($data['retry_after'])) {
            $this->retryAfter = $data['retry_after'];
        }
    }

    public function getMigrateToChatId(): ?int {
        return $this->migrateToChatId;
    }

    public function getRetryAfter(): ?int {
        return $this->retryAfter;
    }


}
