<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents a disabled button which does nothing. Currently holds no information.
 * @link https://core.telegram.org/bots/api#disabledbutton
 */
final class DisabledButton extends AbstractObject {

    public function __construct() {
    }

    public static function fromArray(array $data): DisabledButton {
        return new self();
    }
}
