<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class KeyboardButtonRequestUsers {

    use ObjectTrait;

    /**
     * Request Id
     *
     * Signed 32-bit identifier of the request that will be received back in the UsersShared object. Must be unique within the message
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * User Is Bot
     *
     * Optional. Pass True to request bots, pass False to request regular users. If not specified, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $userIsBot = null;

    /**
     * User Is Premium
     *
     * Optional. Pass True to request premium users, pass False to request non-premium users. If not specified, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $userIsPremium = null;

    /**
     * Max Quantity
     *
     * Optional. The maximum number of users to be selected; 1-10. Defaults to 1.
     * @var int|null
     */
    protected ?int $maxQuantity = null;

    /**
     * Request Name
     *
     * Optional. Pass True to request the users' first and last names
     * @var bool|null
     */
    protected ?bool $requestName = null;

    /**
     * Request Username
     *
     * Optional. Pass True to request the users' usernames
     * @var bool|null
     */
    protected ?bool $requestUsername = null;

    /**
     * Request Photo
     *
     * Optional. Pass True to request the users' photos
     * @var bool|null
     */
    protected ?bool $requestPhoto = null;

    public static function fromArray(array $data): KeyboardButtonRequestUsers {
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
        if (isset($data['max_quantity'])) {
            $instance->maxQuantity = $data['max_quantity'];
        }
        if (isset($data['request_name'])) {
            $instance->requestName = $data['request_name'];
        }
        if (isset($data['request_username'])) {
            $instance->requestUsername = $data['request_username'];
        }
        if (isset($data['request_photo'])) {
            $instance->requestPhoto = $data['request_photo'];
        }
        return $instance;
    }

    public function __construct(
        ?int  $requestId = null,
        ?bool $userIsBot = null,
        ?bool $userIsPremium = null,
        ?int  $maxQuantity = null,
        ?bool $requestName = null,
        ?bool $requestUsername = null,
        ?bool $requestPhoto = null,
    ) {
        $this->requestId = $requestId;
        $this->userIsBot = $userIsBot;
        $this->userIsPremium = $userIsPremium;
        $this->maxQuantity = $maxQuantity;
        $this->requestName = $requestName;
        $this->requestUsername = $requestUsername;
        $this->requestPhoto = $requestPhoto;
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

    public function getMaxQuantity(): ?int {
        return $this->maxQuantity;
    }

    public function setMaxQuantity(?int $value): self {
        $this->maxQuantity = $value;
        return $this;
    }

    public function getRequestName(): ?bool {
        return $this->requestName;
    }

    public function setRequestName(?bool $value): self {
        $this->requestName = $value;
        return $this;
    }

    public function getRequestUsername(): ?bool {
        return $this->requestUsername;
    }

    public function setRequestUsername(?bool $value): self {
        $this->requestUsername = $value;
        return $this;
    }

    public function getRequestPhoto(): ?bool {
        return $this->requestPhoto;
    }

    public function setRequestPhoto(?bool $value): self {
        $this->requestPhoto = $value;
        return $this;
    }

}
