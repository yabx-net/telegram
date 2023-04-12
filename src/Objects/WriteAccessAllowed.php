<?php /** @noinspection PhpUnusedParameterInspection */

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

/**
 * This object represents a service message about a user allowing a bot added to the attachment menu to write messages.
 * Currently holds no information.
 */
final class WriteAccessAllowed {

    use ObjectTrait;

    public static function fromArray(array $data): WriteAccessAllowed {
        return new self();
    }

}
