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

    public function __construct(
        ?string $command = null,
        ?string $description = null,
    ) {
        $this->command = $command;
        $this->description = $description;
    }

    public static function fromArray(array $data): BotCommand {
        $instance = new self();
        if (isset($data['command'])) {
            $instance->command = $data['command'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
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

}
