<?php

namespace Yabx\Telegram\Objects;

class BotCommandScopeChat {

    /**
     * Type
     *
     * Scope type, must be chat
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


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['chat_id'])) {
            $this->chatId = $data['chat_id'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getChatId(): int|string {
        return $this->chatId;
    }


}
