<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about the sender of the message using a link of the other user, which allows sending messages to the user without paying Telegram Stars. Currently holds no information.
 * @link https://core.telegram.org/bots/api#paidmessageswaived
 */
final class PaidMessagesWaived extends AbstractObject {


    public function __construct() {
    }

    public static function fromArray(array $data): PaidMessagesWaived {
        $instance = new self();

        return $instance;
    }

}
