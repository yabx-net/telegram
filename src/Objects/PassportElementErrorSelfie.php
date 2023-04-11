<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PassportElementErrorSelfie {

    use ObjectTrait;

    /**
     * Source
     *
     * Error source, must be selfie
     * @var string|null
     */
    protected ?string $source = null;

    /**
     * Type
     *
     * The section of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * File Hash
     *
     * Base64-encoded hash of the file with the selfie
     * @var string|null
     */
    protected ?string $fileHash = null;

    /**
     * Message
     *
     * Error message
     * @var string|null
     */
    protected ?string $message = null;

    public function __construct(
        ?string $source = null,
        ?string $type = null,
        ?string $fileHash = null,
        ?string $message = null,
    ) {
        $this->source = $source;
        $this->type = $type;
        $this->fileHash = $fileHash;
        $this->message = $message;
    }

    public static function fromArray(array $data): PassportElementErrorSelfie {
        $instance = new self();
        if (isset($data['source'])) {
            $instance->source = $data['source'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['file_hash'])) {
            $instance->fileHash = $data['file_hash'];
        }
        if (isset($data['message'])) {
            $instance->message = $data['message'];
        }
        return $instance;
    }

    public function getSource(): ?string {
        return $this->source;
    }

    public function setSource(?string $value): self {
        $this->source = $value;
        return $this;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getFileHash(): ?string {
        return $this->fileHash;
    }

    public function setFileHash(?string $value): self {
        $this->fileHash = $value;
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
