<?php

namespace Yabx\Telegram\Objects;

final class BotCommandScopeAllGroupChats extends BotCommandScope {

    /**
     * Type
     *
     * Scope type, must be all_group_chats
     * @var string
     */
    protected string $type = 'all_group_chats';

    public static function fromArray(array $data): BotCommandScopeAllGroupChats {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

}
