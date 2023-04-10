<?php

namespace Yabx\Telegram\Objects;

class BotCommand {

    /**
     * Command
     *
     * Text of the command; 1-32 characters. Can contain only lowercase English letters, digits and underscores.
     * @var string
     */
    protected string $command;

    /**
     * Description
     *
     * Description of the command; 1-256 characters.
     * @var string
     */
    protected string $description;


    public function __construct(array $data) {
        if (isset($data['command'])) {
            $this->command = $data['command'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
    }

    public function getCommand(): string {
        return $this->command;
    }

    public function getDescription(): string {
        return $this->description;
    }


}
