<?php

namespace Yabx\Telegram\Objects;

/**
 * This object defines the parameters for the creation of a managed bot. Information about the created bot will be shared with the bot using the update managed_bot and a Message with the field managed_bot_created.
 * @link https://core.telegram.org/bots/api#keyboardbuttonrequestmanagedbot
 */
final class KeyboardButtonRequestManagedBot extends AbstractObject {

    /**
     * Request Id
     *
     * Signed 32-bit identifier of the request. Must be unique within the message
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * Suggested Name
     *
     * Optional. Suggested name for the bot
     * @var string|null
     */
    protected ?string $suggestedName = null;

    /**
     * Suggested Username
     *
     * Optional. Suggested username for the bot
     * @var string|null
     */
    protected ?string $suggestedUsername = null;

    public static function fromArray(array $data): KeyboardButtonRequestManagedBot {
        $instance = new self();
        if (isset($data['request_id'])) {
            $instance->requestId = $data['request_id'];
        }
        if (isset($data['suggested_name'])) {
            $instance->suggestedName = $data['suggested_name'];
        }
        if (isset($data['suggested_username'])) {
            $instance->suggestedUsername = $data['suggested_username'];
        }
        return $instance;
    }

    public function __construct(
        ?int $requestId = null,
        ?string $suggestedName = null,
        ?string $suggestedUsername = null,
    ) {
        $this->requestId = $requestId;
        $this->suggestedName = $suggestedName;
        $this->suggestedUsername = $suggestedUsername;
    }

    public function getRequestId(): ?int {
        return $this->requestId;
    }

    public function setRequestId(?int $value): self {
        $this->requestId = $value;
        return $this;
    }

    public function getSuggestedName(): ?string {
        return $this->suggestedName;
    }

    public function setSuggestedName(?string $value): self {
        $this->suggestedName = $value;
        return $this;
    }

    public function getSuggestedUsername(): ?string {
        return $this->suggestedUsername;
    }

    public function setSuggestedUsername(?string $value): self {
        $this->suggestedUsername = $value;
        return $this;
    }

}
