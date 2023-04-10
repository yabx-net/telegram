<?php

namespace Yabx\Telegram\Objects;

class BotCommandScopeChatMember {

    /**
     * Type
     *
     * Scope type, must be chat_member
     * @var string
     */
    protected string $type;

    /**
     * Chat Id
     *
     * Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @var int|string
     */
    protected int|string $chatId;

    /**
     * User Id
     *
     * Unique identifier of the target user
     * @var int
     */
    protected int $userId;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['chat_id'])) {
            $this->chatId = $data['chat_id'];
        }
        if (isset($data['user_id'])) {
            $this->userId = $data['user_id'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getChatId(): int|string {
        return $this->chatId;
    }

    public function getUserId(): int {
        return $this->userId;
    }


}
