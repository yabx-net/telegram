<?php

namespace Yabx\Telegram\Objects;

class PassportElementErrorTranslationFiles {

    /**
     * Source
     *
     * Error source, must be translation_files
     * @var string
     */
    protected string $source;

    /**
     * Type
     *
     * Type of element of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     * @var string
     */
    protected string $type;

    /**
     * File Hashes
     *
     * List of base64-encoded file hashes
     * @var string[]
     */
    protected array $fileHashes;

    /**
     * Message
     *
     * Error message
     * @var string
     */
    protected string $message;


    public function __construct(array $data) {
        if (isset($data['source'])) {
            $this->source = $data['source'];
        }
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['file_hashes'])) {
            $this->fileHashes = [];
            foreach ($data['file_hashes'] as $item) {
                $this->fileHashes[] = $item;
            }
        }
        if (isset($data['message'])) {
            $this->message = $data['message'];
        }
    }

    public function getSource(): string {
        return $this->source;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getFileHashes(): array {
        return $this->fileHashes;
    }

    public function getMessage(): string {
        return $this->message;
    }


}
