<?php

namespace Yabx\Telegram\Objects;

class PassportElementErrorUnspecified {

    /**
     * Source
     *
     * Error source, must be unspecified
     * @var string
     */
    protected string $source;

    /**
     * Type
     *
     * Type of element of the user's Telegram Passport which has the issue
     * @var string
     */
    protected string $type;

    /**
     * Element Hash
     *
     * Base64-encoded element hash
     * @var string
     */
    protected string $elementHash;

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
        if (isset($data['element_hash'])) {
            $this->elementHash = $data['element_hash'];
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

    public function getElementHash(): string {
        return $this->elementHash;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
