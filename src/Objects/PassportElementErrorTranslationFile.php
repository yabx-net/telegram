<?php

namespace Yabx\Telegram\Objects;

class PassportElementErrorTranslationFile {

    /**
     * Source
     *
     * Error source, must be translation_file
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
     * File Hash
     *
     * Base64-encoded file hash
     * @var string
     */
    protected string $fileHash;

    /**
     * Message
     *
     * Error message
     * @var string
     */
    protected string $message;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['source'])) {
            $this->source = $data['source'];
        }
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['file_hash'])) {
            $this->fileHash = $data['file_hash'];
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

    public function getFileHash(): string {
        return $this->fileHash;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
