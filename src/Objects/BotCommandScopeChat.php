<?php

namespace Yabx\Telegram\Objects;

final class BotCommandScopeChat extends BotCommandScope {

    /**
     * Type
     *
     * Scope type, must be chat
     * @var string
     */
    protected string $type = 'chat';

    /**
     * Chat Id
     *
     * Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @var int|string|null
     */
    protected int|string|null $chatId = null;

    public function __construct(
        int|string|null $chatId = null,
    ) {
        $this->chatId = $chatId;
    }

    public static function fromArray(array $data): BotCommandScopeChat {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['chat_id'])) {
            $instance->chatId = $data['chat_id'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getChatId(): int|string|null {
        return $this->chatId;
    }

    public function setChatId(int|string|null $value): self {
        $this->chatId = $value;
        return $this;
    }

}
