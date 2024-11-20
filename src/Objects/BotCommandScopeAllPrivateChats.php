<?php

namespace Yabx\Telegram\Objects;

final class BotCommandScopeAllPrivateChats extends BotCommandScope {

    /**
     * Type
     *
     * Scope type, must be all_private_chats
     * @var string
     */
    protected string $type = 'all_private_chats';

    public static function fromArray(array $data): BotCommandScopeAllPrivateChats {
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
