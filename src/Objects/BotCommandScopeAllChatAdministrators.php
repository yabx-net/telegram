<?php

namespace Yabx\Telegram\Objects;

final class BotCommandScopeAllChatAdministrators extends BotCommandScope {
    /**
     * Type
     *
     * Scope type, must be all_chat_administrators
     * @var string
     */
    protected string $type = 'all_chat_administrators';

    public static function fromArray(array $data): BotCommandScopeAllChatAdministrators {
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
