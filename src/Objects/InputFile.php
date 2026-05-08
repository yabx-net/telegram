<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents the contents of a file to be uploaded. Must be posted using multipart/form-data in the usual way that files are uploaded via the browser.
 * @link https://core.telegram.org/bots/api#inputfile
 */
final class InputFile extends AbstractObject {

    public static function fromArray(array $data): InputFile {
        return new self();
    }

}
