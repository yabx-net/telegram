<?php

namespace Yabx\Telegram\Objects;

class KeyboardButtonRequestChat {

    /**
     * Request Id
     *
     * Signed 32-bit identifier of the request, which will be received back in the ChatShared object. Must be unique within the message
     * @var int
     */
    protected int $requestId;

    /**
     * Chat Is Channel
     *
     * Pass True to request a channel chat, pass False to request a group or a supergroup chat.
     * @var bool
     */
    protected bool $chatIsChannel;

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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['request_id'])) {
            $this->requestId = $data['request_id'];
        }
        if (isset($data['chat_is_channel'])) {
            $this->chatIsChannel = $data['chat_is_channel'];
        }
        if (isset($data['chat_is_forum'])) {
            $this->chatIsForum = $data['chat_is_forum'];
        }
        if (isset($data['chat_has_username'])) {
            $this->chatHasUsername = $data['chat_has_username'];
        }
        if (isset($data['chat_is_created'])) {
            $this->chatIsCreated = $data['chat_is_created'];
        }
        if (isset($data['user_administrator_rights'])) {
            $this->userAdministratorRights = new ChatAdministratorRights($data['user_administrator_rights']);
        }
        if (isset($data['bot_administrator_rights'])) {
            $this->botAdministratorRights = new ChatAdministratorRights($data['bot_administrator_rights']);
        }
        if (isset($data['bot_is_member'])) {
            $this->botIsMember = $data['bot_is_member'];
        }
    }

    public function getRequestId(): int {
        return $this->requestId;
    }

    public function getChatIsChannel(): bool {
        return $this->chatIsChannel;
    }

    public function getChatIsForum(): ?bool {
        return $this->chatIsForum;
    }

    public function getChatHasUsername(): ?bool {
        return $this->chatHasUsername;
    }

    public function getChatIsCreated(): ?bool {
        return $this->chatIsCreated;
    }

    public function getUserAdministratorRights(): ?ChatAdministratorRights {
        return $this->userAdministratorRights;
    }

    public function getBotAdministratorRights(): ?ChatAdministratorRights {
        return $this->botAdministratorRights;
    }

    public function getBotIsMember(): ?bool {
        return $this->botIsMember;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
