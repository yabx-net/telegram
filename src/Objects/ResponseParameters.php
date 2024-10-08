<?php

namespace Yabx\Telegram\Objects;

final class ResponseParameters extends AbstractObject {

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

    public static function fromArray(array $data): ResponseParameters {
        $instance = new self();
        if (isset($data['migrate_to_chat_id'])) {
            $instance->migrateToChatId = $data['migrate_to_chat_id'];
        }
        if (isset($data['retry_after'])) {
            $instance->retryAfter = $data['retry_after'];
        }
        return $instance;
    }

    public function __construct(
        ?int $migrateToChatId = null,
        ?int $retryAfter = null,
    ) {
        $this->migrateToChatId = $migrateToChatId;
        $this->retryAfter = $retryAfter;
    }

    public function getMigrateToChatId(): ?int {
        return $this->migrateToChatId;
    }

    public function setMigrateToChatId(?int $value): self {
        $this->migrateToChatId = $value;
        return $this;
    }

    public function getRetryAfter(): ?int {
        return $this->retryAfter;
    }

    public function setRetryAfter(?int $value): self {
        $this->retryAfter = $value;
        return $this;
    }

}
