<?php

namespace Yabx\Telegram\Objects;

final class BotCommandScopeDefault extends BotCommandScope {

    /**
     * Type
     *
     * Scope type, must be default
     * @var string
     */
    protected string $type = 'default';

    public static function fromArray(array $data): BotCommandScopeDefault {
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
