<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;
use Yabx\Telegram\ObjectTrait;

abstract class MenuButton {

    use ObjectTrait;

    public static function fromArray(array $data): MenuButton {
        return match ($data['type'] ?? null) {
            'commands' => MenuButtonCommands::fromArray($data),
            'default' => MenuButtonDefault::fromArray($data),
            'web_app' => MenuButtonWebApp::fromArray($data),
            default => throw new Exception('Failed to create MenuButton')
        };
    }

}
