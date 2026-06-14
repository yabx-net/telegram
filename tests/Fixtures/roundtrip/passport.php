<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\EncryptedCredentials;
use Yabx\Telegram\Objects\EncryptedPassportElement;
use Yabx\Telegram\Objects\PassportData;
use Yabx\Telegram\Objects\PassportElementErrorDataField;
use Yabx\Telegram\Objects\PassportElementErrorFile;
use Yabx\Telegram\Objects\PassportElementErrorFiles;
use Yabx\Telegram\Objects\PassportElementErrorFrontSide;
use Yabx\Telegram\Objects\PassportElementErrorReverseSide;
use Yabx\Telegram\Objects\PassportElementErrorSelfie;
use Yabx\Telegram\Objects\PassportElementErrorTranslationFile;
use Yabx\Telegram\Objects\PassportElementErrorTranslationFiles;
use Yabx\Telegram\Objects\PassportElementErrorUnspecified;
use Yabx\Telegram\Objects\PassportFile;

return [
    PassportFile::class => [
        'file_id' => 'pf-1',
        'file_unique_id' => 'pf-u',
        'file_size' => 1024,
        'file_date' => 1681135130,
    ],
    EncryptedCredentials::class => [
        'data' => 'encrypted-data',
        'hash' => 'hash',
        'secret' => 'secret',
    ],
    EncryptedPassportElement::class => [
        'type' => 'email',
        'email' => 'user@example.com',
    ],
    PassportData::class => [
        'data' => [
            ['type' => 'email', 'email' => 'user@example.com'],
        ],
        'credentials' => [
            'data' => 'encrypted-data',
            'hash' => 'hash',
            'secret' => 'secret',
        ],
    ],
    PassportElementErrorFrontSide::class => [
        'source' => 'front_side',
        'type' => 'passport',
        'file_hash' => 'abc',
        'message' => 'Invalid',
    ],
    PassportElementErrorFile::class => [
        'source' => 'file',
        'type' => 'passport',
        'file_hash' => 'abc',
        'message' => 'Invalid',
    ],
    PassportElementErrorFiles::class => [
        'source' => 'files',
        'type' => 'passport',
        'file_hashes' => ['abc'],
        'message' => 'Invalid',
    ],
    PassportElementErrorDataField::class => [
        'source' => 'data',
        'type' => 'passport',
        'field_name' => 'first_name',
        'data_hash' => 'abc',
        'message' => 'Invalid',
    ],
    PassportElementErrorReverseSide::class => [
        'source' => 'reverse_side',
        'type' => 'passport',
        'file_hash' => 'abc',
        'message' => 'Invalid',
    ],
    PassportElementErrorSelfie::class => [
        'source' => 'selfie',
        'type' => 'passport',
        'file_hash' => 'abc',
        'message' => 'Invalid',
    ],
    PassportElementErrorTranslationFile::class => [
        'source' => 'translation_file',
        'type' => 'passport',
        'file_hash' => 'abc',
        'message' => 'Invalid',
    ],
    PassportElementErrorTranslationFiles::class => [
        'source' => 'translation_files',
        'type' => 'passport',
        'file_hashes' => ['abc'],
        'message' => 'Invalid',
    ],
    PassportElementErrorUnspecified::class => [
        'source' => 'unspecified',
        'type' => 'passport',
        'element_hash' => 'abc',
        'message' => 'Invalid',
    ],
];
