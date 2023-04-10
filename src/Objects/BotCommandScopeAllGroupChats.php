<?php

namespace Yabx\Telegram\Objects;

class BotCommandScopeAllGroupChats {

    /**
     * Type
     *
     * Scope type, must be all_group_chats
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
