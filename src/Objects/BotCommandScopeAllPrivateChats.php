<?php

namespace Yabx\Telegram\Objects;

class BotCommandScopeAllPrivateChats {

    /**
     * Type
     *
     * Scope type, must be all_private_chats
     * @var string
     */
    protected string $type;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
    }

    public function getType(): string {
        return $this->type;
    }


}
