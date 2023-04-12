<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

/**
 * This object represents a service message about a video chat started in the chat.
 * Currently holds no information.
 */
final class VideoChatStarted {

    use ObjectTrait;

    public static function fromArray(array $data): VideoChatStarted {
        return new self();
    }

}
