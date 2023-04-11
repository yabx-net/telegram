<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class KeyboardButtonRequestUser {

    use ObjectTrait;

    /**
     * Request Id
     *
     * Signed 32-bit identifier of the request, which will be received back in the UserShared object. Must be unique within the message
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * User Is Bot
     *
     * Optional. Pass True to request a bot, pass False to request a regular user. If not specified, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $userIsBot = null;

    /**
     * User Is Premium
     *
     * Optional. Pass True to request a premium user, pass False to request a non-premium user. If not specified, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $userIsPremium = null;

    public function __construct(
        ?int  $requestId = null,
        ?bool $userIsBot = null,
        ?bool $userIsPremium = null,
    ) {
        $this->requestId = $requestId;
        $this->userIsBot = $userIsBot;
        $this->userIsPremium = $userIsPremium;
    }

    public static function fromArray(array $data): KeyboardButtonRequestUser {
        $instance = new self();
        if (isset($data['request_id'])) {
            $instance->requestId = $data['request_id'];
        }
        if (isset($data['user_is_bot'])) {
            $instance->userIsBot = $data['user_is_bot'];
        }
        if (isset($data['user_is_premium'])) {
            $instance->userIsPremium = $data['user_is_premium'];
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

    public function getUserIsBot(): ?bool {
        return $this->userIsBot;
    }

    public function setUserIsBot(?bool $value): self {
        $this->userIsBot = $value;
        return $this;
    }

    public function getUserIsPremium(): ?bool {
        return $this->userIsPremium;
    }

    public function setUserIsPremium(?bool $value): self {
        $this->userIsPremium = $value;
        return $this;
    }

}
