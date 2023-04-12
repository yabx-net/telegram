<?php

namespace Yabx\Telegram\Objects;

final class BotCommandScopeAllChatAdministrators extends BotCommandScope {
    /**
     * Type
     *
     * Scope type, must be all_chat_administrators
     * @var string|null
     */
    protected ?string $type = null;

    public function __construct(
        ?string $type = null,
    ) {
        $this->type = $type;
    }

    public static function fromArray(array $data): BotCommandScopeAllChatAdministrators {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
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

}
