<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BotCommandScopeChatAdministrators {

    use ObjectTrait;

    /**
     * Type
     *
     * Scope type, must be chat_administrators
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Chat Id
     *
     * Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @var int|string|null
     */
    protected int|string|null $chatId = null;

    public function __construct(
        ?string         $type = null,
        int|string|null $chatId = null,
    ) {
        $this->type = $type;
        $this->chatId = $chatId;
    }

    public static function fromArray(array $data): BotCommandScopeChatAdministrators {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['chat_id'])) {
            $instance->chatId = $data['chat_id'];
        }
        return $instance;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getChatId(): int|string|null {
        return $this->chatId;
    }

    public function setChatId(int|string|null $value): self {
        $this->chatId = $value;
        return $this;
    }

}
