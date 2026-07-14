<?php

namespace Yabx\Telegram\Objects;

final class BotCommand extends AbstractObject {

    /**
     * Command
     *
     * Text of the command; 1-32 characters. Can contain only lowercase English letters, digits and underscores.
     * @var string|null
     */
    protected ?string $command = null;

    /**
     * Description
     *
     * Description of the command; 1-256 characters.
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Is Ephemeral
     *
     * Optional. True, if the command sends an ephemeral message, which can be seen only by the sender of the message and the bot
     * @var bool|null
     */
    protected ?bool $isEphemeral = null;

    public function __construct(
        ?string $command = null,
        ?string $description = null,
        ?bool $isEphemeral = null,
    ) {
        $this->command = $command;
        $this->description = $description;
        $this->isEphemeral = $isEphemeral;
    }

    public static function fromArray(array $data): BotCommand {
        $instance = new self();
        if (isset($data['command'])) {
            $instance->command = $data['command'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['is_ephemeral'])) {
            $instance->isEphemeral = $data['is_ephemeral'];
        }
        return $instance;
    }

    public function getCommand(): ?string {
        return $this->command;
    }

    public function setCommand(?string $value): self {
        $this->command = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
        return $this;
    }

    public function getIsEphemeral(): ?bool {
        return $this->isEphemeral;
    }

    public function setIsEphemeral(?bool $value): self {
        $this->isEphemeral = $value;
        return $this;
    }

}
