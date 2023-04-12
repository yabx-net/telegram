<?php

namespace Yabx\Telegram\Objects;

final class BotCommandScopeChatMember extends BotCommandScope {

    /**
     * Type
     *
     * Scope type, must be chat_member
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

    /**
     * User Id
     *
     * Unique identifier of the target user
     * @var int|null
     */
    protected ?int $userId = null;

    public function __construct(
        ?string         $type = null,
        int|string|null $chatId = null,
        ?int            $userId = null,
    ) {
        $this->type = $type;
        $this->chatId = $chatId;
        $this->userId = $userId;
    }

    public static function fromArray(array $data): BotCommandScopeChatMember {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['chat_id'])) {
            $instance->chatId = $data['chat_id'];
        }
        if (isset($data['user_id'])) {
            $instance->userId = $data['user_id'];
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

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $value): self {
        $this->userId = $value;
        return $this;
    }

}
