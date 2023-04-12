<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

/**
 * A placeholder, currently holds no information.
 * Use BotFather to set up your game.
 */
final class CallbackGame {

    use ObjectTrait;

    public static function fromArray(array $data): CallbackGame {
        return new self();
    }

}
