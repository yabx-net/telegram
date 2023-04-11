<?php

namespace Yabx\Telegram\Objects;

class BotCommandScopeAllChatAdministrators {

    /**
     * Type
     *
     * Scope type, must be all_chat_administrators
     * @var string
     */
    protected string $type;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
