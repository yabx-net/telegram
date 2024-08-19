<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class SwitchInlineQueryChosenChat {

    use ObjectTrait;

    /**
     * Query
     *
     * Optional. The default inline query to be inserted in the input field. If left empty, only the bot's username will be inserted
     * @var string|null
     */
    protected ?string $query = null;

    /**
     * Allow User Chats
     *
     * Optional. True, if private chats with users can be chosen
     * @var bool|null
     */
    protected ?bool $allowUserChats = null;

    /**
     * Allow Bot Chats
     *
     * Optional. True, if private chats with bots can be chosen
     * @var bool|null
     */
    protected ?bool $allowBotChats = null;

    /**
     * Allow Group Chats
     *
     * Optional. True, if group and supergroup chats can be chosen
     * @var bool|null
     */
    protected ?bool $allowGroupChats = null;

    /**
     * Allow Channel Chats
     *
     * Optional. True, if channel chats can be chosen
     * @var bool|null
     */
    protected ?bool $allowChannelChats = null;

    public static function fromArray(array $data): SwitchInlineQueryChosenChat {
        $instance = new self();
        if (isset($data['query'])) {
            $instance->query = $data['query'];
        }
        if (isset($data['allow_user_chats'])) {
            $instance->allowUserChats = $data['allow_user_chats'];
        }
        if (isset($data['allow_bot_chats'])) {
            $instance->allowBotChats = $data['allow_bot_chats'];
        }
        if (isset($data['allow_group_chats'])) {
            $instance->allowGroupChats = $data['allow_group_chats'];
        }
        if (isset($data['allow_channel_chats'])) {
            $instance->allowChannelChats = $data['allow_channel_chats'];
        }
        return $instance;
    }

    public function __construct(
        ?string $query = null,
        ?bool   $allowUserChats = null,
        ?bool   $allowBotChats = null,
        ?bool   $allowGroupChats = null,
        ?bool   $allowChannelChats = null,
    ) {
        $this->query = $query;
        $this->allowUserChats = $allowUserChats;
        $this->allowBotChats = $allowBotChats;
        $this->allowGroupChats = $allowGroupChats;
        $this->allowChannelChats = $allowChannelChats;
    }

    public function getQuery(): ?string {
        return $this->query;
    }

    public function setQuery(?string $value): self {
        $this->query = $value;
        return $this;
    }

    public function getAllowUserChats(): ?bool {
        return $this->allowUserChats;
    }

    public function setAllowUserChats(?bool $value): self {
        $this->allowUserChats = $value;
        return $this;
    }

    public function getAllowBotChats(): ?bool {
        return $this->allowBotChats;
    }

    public function setAllowBotChats(?bool $value): self {
        $this->allowBotChats = $value;
        return $this;
    }

    public function getAllowGroupChats(): ?bool {
        return $this->allowGroupChats;
    }

    public function setAllowGroupChats(?bool $value): self {
        $this->allowGroupChats = $value;
        return $this;
    }

    public function getAllowChannelChats(): ?bool {
        return $this->allowChannelChats;
    }

    public function setAllowChannelChats(?bool $value): self {
        $this->allowChannelChats = $value;
        return $this;
    }

}
