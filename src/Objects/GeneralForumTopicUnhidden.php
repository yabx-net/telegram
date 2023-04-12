<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

/**
 * This object represents a service message about General forum topic unhidden in the chat.
 * Currently holds no information.
 */
final class GeneralForumTopicUnhidden {

    use ObjectTrait;

    public static function fromArray(array $data): GeneralForumTopicUnhidden {
        return new self();
    }

}
