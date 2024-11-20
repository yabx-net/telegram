<?php

namespace Yabx\Telegram\Objects;

final class MenuButtonCommands extends MenuButton {

    /**
     * Type
     *
     * Type of the button, must be commands
     * @var string
     */
    protected string $type = 'commands';

    public static function fromArray(array $data): MenuButtonCommands {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

}
