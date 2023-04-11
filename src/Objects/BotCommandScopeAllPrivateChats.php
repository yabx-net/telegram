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
