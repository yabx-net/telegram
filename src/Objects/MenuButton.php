<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;


abstract class MenuButton extends AbstractObject {

    public static function fromArray(array $data): MenuButton {
        return match ($data['type']) {
            'commands' => MenuButtonCommands::fromArray($data),
            'default' => MenuButtonDefault::fromArray($data),
            'web_app' => MenuButtonWebApp::fromArray($data),
            default => throw new Exception('Failed to create MenuButton')
        };
    }

}
