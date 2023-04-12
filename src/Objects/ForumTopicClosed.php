<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

/**
 * This object represents a service message about a forum topic closed in the chat.
 * Currently holds no information.
 */
final class ForumTopicClosed {

    use ObjectTrait;

    public static function fromArray(array $data): ForumTopicClosed {
        return new self();
    }

}
