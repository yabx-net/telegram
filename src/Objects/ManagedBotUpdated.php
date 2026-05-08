<?php

namespace Yabx\Telegram\Objects;

/**
 * This object contains information about the creation, token update, or owner update of a bot that is managed by the current bot.
 * @link https://core.telegram.org/bots/api#managedbotupdated
 */
final class ManagedBotUpdated extends AbstractObject {

    /**
     * User
     *
     * User that created the bot
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Bot
     *
     * Information about the bot. Token of the bot can be fetched using the method getManagedBotToken.
     * @var User|null
     */
    protected ?User $bot = null;

    public static function fromArray(array $data): ManagedBotUpdated {
        $instance = new self();
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['bot'])) {
            $instance->bot = User::fromArray($data['bot']);
        }
        return $instance;
    }

    public function __construct(
        ?User $user = null,
        ?User $bot = null,
    ) {
        $this->user = $user;
        $this->bot = $bot;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getBot(): ?User {
        return $this->bot;
    }

    public function setBot(?User $value): self {
        $this->bot = $value;
        return $this;
    }

}
