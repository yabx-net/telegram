<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;
use Yabx\Telegram\ObjectTrait;

abstract class InputMessageContent {

    use ObjectTrait;

    public static function fromArray(array $data): InputMessageContent {
        if(key_exists('message_text', $data)) return InputTextMessageContent::fromArray($data);
        if(key_exists('latitude', $data) && key_exists('title', $data)) return InputVenueMessageContent::fromArray($data);
        if(key_exists('latitude', $data)) return InputLocationMessageContent::fromArray($data);
        if(key_exists('phone_number', $data)) return InputContactMessageContent::fromArray($data);
        if(key_exists('currency', $data)) return InputInvoiceMessageContent::fromArray($data);
        throw new Exception('Failed to create InputMessageContent');
    }

}
