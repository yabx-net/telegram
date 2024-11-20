<?php

namespace Yabx\Telegram\Objects;

final class MenuButtonDefault extends MenuButton {

    /**
     * Type
     *
     * Type of the button, must be default
     * @var string
     */
    protected string $type = 'default';

    public static function fromArray(array $data): MenuButtonDefault {
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
