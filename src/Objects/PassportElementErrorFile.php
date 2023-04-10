<?php

namespace Yabx\Telegram\Objects;

class PassportElementErrorFile {

    /**
     * Source
     *
     * Error source, must be file
     * @var string
     */
    protected string $source;

    /**
     * Type
     *
     * The section of the user's Telegram Passport which has the issue, one of “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
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


    public function __construct(array $data) {
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


}
