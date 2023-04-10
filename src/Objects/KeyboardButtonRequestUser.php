<?php

namespace Yabx\Telegram\Objects;

class KeyboardButtonRequestUser {

    /**
     * Request Id
     *
     * Signed 32-bit identifier of the request, which will be received back in the UserShared object. Must be unique within the message
     * @var int
     */
    protected int $requestId;

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


    public function __construct(array $data) {
        if (isset($data['request_id'])) {
            $this->requestId = $data['request_id'];
        }
        if (isset($data['user_is_bot'])) {
            $this->userIsBot = $data['user_is_bot'];
        }
        if (isset($data['user_is_premium'])) {
            $this->userIsPremium = $data['user_is_premium'];
        }
    }

    public function getRequestId(): int {
        return $this->requestId;
    }

    public function getUserIsBot(): ?bool {
        return $this->userIsBot;
    }

    public function getUserIsPremium(): ?bool {
        return $this->userIsPremium;
    }


}
