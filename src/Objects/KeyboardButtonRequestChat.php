<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class KeyboardButtonRequestChat {

    use ObjectTrait;

    /**
     * Request Id
     *
     * Signed 32-bit identifier of the request, which will be received back in the ChatShared object. Must be unique within the message
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * Chat Is Channel
     *
     * Pass True to request a channel chat, pass False to request a group or a supergroup chat.
     * @var bool|null
     */
    protected ?bool $chatIsChannel = null;

    /**
     * Chat Is Forum
     *
     * Optional. Pass True to request a forum supergroup, pass False to request a non-forum chat. If not specified, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $chatIsForum = null;

    /**
     * Chat Has Username
     *
     * Optional. Pass True to request a supergroup or a channel with a username, pass False to request a chat without a username. If not specified, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $chatHasUsername = null;

    /**
     * Chat Is Created
     *
     * Optional. Pass True to request a chat owned by the user. Otherwise, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $chatIsCreated = null;

    /**
     * User Administrator Rights
     *
     * Optional. A JSON-serialized object listing the required administrator rights of the user in the chat. The rights must be a superset of bot_administrator_rights. If not specified, no additional restrictions are applied.
     * @var ChatAdministratorRights|null
     */
    protected ?ChatAdministratorRights $userAdministratorRights = null;

    /**
     * Bot Administrator Rights
     *
     * Optional. A JSON-serialized object listing the required administrator rights of the bot in the chat. The rights must be a subset of user_administrator_rights. If not specified, no additional restrictions are applied.
     * @var ChatAdministratorRights|null
     */
    protected ?ChatAdministratorRights $botAdministratorRights = null;

    /**
     * Bot Is Member
     *
     * Optional. Pass True to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
     * @var bool|null
     */
    protected ?bool $botIsMember = null;

    /**
     * Request Title
     *
     * Optional. Pass True to request the chat's title
     * @var bool|null
     */
    protected ?bool $requestTitle = null;

    /**
     * Request Username
     *
     * Optional. Pass True to request the chat's username
     * @var bool|null
     */
    protected ?bool $requestUsername = null;

    /**
     * Request Photo
     *
     * Optional. Pass True to request the chat's photo
     * @var bool|null
     */
    protected ?bool $requestPhoto = null;

    public function __construct(
        ?int                     $requestId = null,
        ?bool                    $chatIsChannel = null,
        ?bool                    $chatIsForum = null,
        ?bool                    $chatHasUsername = null,
        ?bool                    $chatIsCreated = null,
        ?ChatAdministratorRights $userAdministratorRights = null,
        ?ChatAdministratorRights $botAdministratorRights = null,
        ?bool                    $botIsMember = null,
        ?bool                    $requestTitle = null,
        ?bool                    $requestUsername = null,
        ?bool                    $requestPhoto = null,
    ) {
        $this->requestId = $requestId;
        $this->chatIsChannel = $chatIsChannel;
        $this->chatIsForum = $chatIsForum;
        $this->chatHasUsername = $chatHasUsername;
        $this->chatIsCreated = $chatIsCreated;
        $this->userAdministratorRights = $userAdministratorRights;
        $this->botAdministratorRights = $botAdministratorRights;
        $this->botIsMember = $botIsMember;
        $this->requestTitle = $requestTitle;
        $this->requestUsername = $requestUsername;
        $this->requestPhoto = $requestPhoto;
    }

    public static function fromArray(array $data): KeyboardButtonRequestChat {
        $instance = new self();
        if (isset($data['request_id'])) {
            $instance->requestId = $data['request_id'];
        }
        if (isset($data['chat_is_channel'])) {
            $instance->chatIsChannel = $data['chat_is_channel'];
        }
        if (isset($data['chat_is_forum'])) {
            $instance->chatIsForum = $data['chat_is_forum'];
        }
        if (isset($data['chat_has_username'])) {
            $instance->chatHasUsername = $data['chat_has_username'];
        }
        if (isset($data['chat_is_created'])) {
            $instance->chatIsCreated = $data['chat_is_created'];
        }
        if (isset($data['user_administrator_rights'])) {
            $instance->userAdministratorRights = ChatAdministratorRights::fromArray($data['user_administrator_rights']);
        }
        if (isset($data['bot_administrator_rights'])) {
            $instance->botAdministratorRights = ChatAdministratorRights::fromArray($data['bot_administrator_rights']);
        }
        if (isset($data['bot_is_member'])) {
            $instance->botIsMember = $data['bot_is_member'];
        }
        if (isset($data['request_title'])) {
            $instance->requestTitle = $data['request_title'];
        }
        if (isset($data['request_username'])) {
            $instance->requestUsername = $data['request_username'];
        }
        if (isset($data['request_photo'])) {
            $instance->requestPhoto = $data['request_photo'];
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

    public function getChatIsChannel(): ?bool {
        return $this->chatIsChannel;
    }

    public function setChatIsChannel(?bool $value): self {
        $this->chatIsChannel = $value;
        return $this;
    }

    public function getChatIsForum(): ?bool {
        return $this->chatIsForum;
    }

    public function setChatIsForum(?bool $value): self {
        $this->chatIsForum = $value;
        return $this;
    }

    public function getChatHasUsername(): ?bool {
        return $this->chatHasUsername;
    }

    public function setChatHasUsername(?bool $value): self {
        $this->chatHasUsername = $value;
        return $this;
    }

    public function getChatIsCreated(): ?bool {
        return $this->chatIsCreated;
    }

    public function setChatIsCreated(?bool $value): self {
        $this->chatIsCreated = $value;
        return $this;
    }

    public function getUserAdministratorRights(): ?ChatAdministratorRights {
        return $this->userAdministratorRights;
    }

    public function setUserAdministratorRights(?ChatAdministratorRights $value): self {
        $this->userAdministratorRights = $value;
        return $this;
    }

    public function getBotAdministratorRights(): ?ChatAdministratorRights {
        return $this->botAdministratorRights;
    }

    public function setBotAdministratorRights(?ChatAdministratorRights $value): self {
        $this->botAdministratorRights = $value;
        return $this;
    }

    public function getBotIsMember(): ?bool {
        return $this->botIsMember;
    }

    public function setBotIsMember(?bool $value): self {
        $this->botIsMember = $value;
        return $this;
    }

    public function getRequestTitle(): ?bool {
        return $this->requestTitle;
    }

    public function setRequestTitle(?bool $value): self {
        $this->requestTitle = $value;
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
