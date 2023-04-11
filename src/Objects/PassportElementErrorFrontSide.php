<?php

namespace Yabx\Telegram\Objects;

class PassportElementErrorFrontSide {

    /**
     * Source
     *
     * Error source, must be front_side
     * @var string
     */
    protected string $source;

    /**
     * Type
     *
     * The section of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”
     * @var string
     */
    protected string $type;

    /**
     * File Hash
     *
     * Base64-encoded hash of the file with the front side of the document
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
