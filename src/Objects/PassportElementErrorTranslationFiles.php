<?php

namespace Yabx\Telegram\Objects;

final class PassportElementErrorTranslationFiles extends PassportElementError {

    /**
     * Source
     *
     * Error source, must be translation_files
     * @var string
     */
    protected string $source = 'translation_files';

    /**
     * Type
     *
     * Type of element of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * File Hashes
     *
     * List of base64-encoded file hashes
     * @var string[]|null
     */
    protected ?array $fileHashes = null;

    /**
     * Message
     *
     * Error message
     * @var string|null
     */
    protected ?string $message = null;

    public static function fromArray(array $data): PassportElementErrorTranslationFiles {
        $instance = new self();
        if (isset($data['source'])) {
            $instance->source = $data['source'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['file_hashes'])) {
            $instance->fileHashes = [];
            foreach ($data['file_hashes'] as $item) {
                $instance->fileHashes[] = $item;
            }
        }
        if (isset($data['message'])) {
            $instance->message = $data['message'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?array  $fileHashes = null,
        ?string $message = null,
    ) {
        $this->type = $type;
        $this->fileHashes = $fileHashes;
        $this->message = $message;
    }

    public function getSource(): string {
        return $this->source;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getFileHashes(): ?array {
        return $this->fileHashes;
    }

    public function setFileHashes(?array $value): self {
        $this->fileHashes = $value;
        return $this;
    }

    public function getMessage(): ?string {
        return $this->message;
    }

    public function setMessage(?string $value): self {
        $this->message = $value;
        return $this;
    }

}
