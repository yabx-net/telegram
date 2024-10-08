<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;


abstract class InputMessageContent extends AbstractObject {

    public static function fromArray(array $data): mixed {
        if (key_exists('message_text', $data)) return InputTextMessageContent::fromArray($data);
        elseif (key_exists('latitude', $data) && key_exists('title', $data)) return InputVenueMessageContent::fromArray($data);
        elseif (key_exists('latitude', $data)) return InputLocationMessageContent::fromArray($data);
        elseif (key_exists('phone_number', $data)) return InputContactMessageContent::fromArray($data);
        elseif (key_exists('currency', $data)) return InputInvoiceMessageContent::fromArray($data);
        else throw new Exception('Failed to create InputMessageContent');
    }

}
