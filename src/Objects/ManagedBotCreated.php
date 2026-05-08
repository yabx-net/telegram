<?php

namespace Yabx\Telegram\Objects;

/**
 * This object contains information about the bot that was created to be managed by the current bot.
 * @link https://core.telegram.org/bots/api#managedbotcreated
 */
final class ManagedBotCreated extends AbstractObject {

    /**
     * Bot
     *
     * Information about the bot. The bot's token can be fetched using the method getManagedBotToken.
     * @var User|null
     */
    protected ?User $bot = null;

    public static function fromArray(array $data): ManagedBotCreated {
        $instance = new self();
        if (isset($data['bot'])) {
            $instance->bot = User::fromArray($data['bot']);
        }
        return $instance;
    }

    public function __construct(
        ?User $bot = null,
    ) {
        $this->bot = $bot;
    }

    public function getBot(): ?User {
        return $this->bot;
    }

    public function setBot(?User $value): self {
        $this->bot = $value;
        return $this;
    }

}
