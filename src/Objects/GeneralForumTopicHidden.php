<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

/**
 * This object represents a service message about General forum topic hidden in the chat.
 * Currently holds no information.
 */
final class GeneralForumTopicHidden {

    use ObjectTrait;

    public static function fromArray(array $data): GeneralForumTopicHidden {
        return new self();
    }

}
