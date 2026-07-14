<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a chat being removed from a community. Currently holds no information.
 * @link https://core.telegram.org/bots/api#communitychatremoved
 */
final class CommunityChatRemoved extends AbstractObject {

    public function __construct() {
    }

    public static function fromArray(array $data): CommunityChatRemoved {
        return new self();
    }
}
