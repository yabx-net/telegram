<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;
/**
 * This object represents a service message about a video chat started in the chat.
 * Currently holds no information.
 */
final class VideoChatStarted extends AbstractObject {

    public static function fromArray(array $data): VideoChatStarted {
        return new self();
    }

}
