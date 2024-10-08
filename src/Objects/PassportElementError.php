<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;
use Yabx\Telegram\ObjectTrait;

abstract class PassportElementError {

    use ObjectTrait;

    public static function fromArray(array $data): PassportElementError {
        return match ($data['source']) {
            'data' => PassportElementErrorDataField::fromArray($data),
            'front_side' => PassportElementErrorFrontSide::fromArray($data),
            'reverse_side' => PassportElementErrorReverseSide::fromArray($data),
            'selfie' => PassportElementErrorSelfie::fromArray($data),
            'file' => PassportElementErrorFile::fromArray($data),
            'files' => PassportElementErrorFiles::fromArray($data),
            'translation_file' => PassportElementErrorTranslationFile::fromArray($data),
            'translation_files' => PassportElementErrorTranslationFiles::fromArray($data),
            'unspecified' => PassportElementErrorUnspecified::fromArray($data),
            default => throw new InvalidArgumentException('Invalid element type'),
        };
    }

}
