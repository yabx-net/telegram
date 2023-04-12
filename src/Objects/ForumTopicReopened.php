<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

/**
 * This object represents a service message about a forum topic reopened in the chat.
 * Currently holds no information.
 */
final class ForumTopicReopened {

    use ObjectTrait;

    public static function fromArray(array $data): ForumTopicReopened {
        return new self();
    }

}
