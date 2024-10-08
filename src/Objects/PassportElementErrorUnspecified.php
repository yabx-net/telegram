<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PassportElementErrorUnspecified extends PassportElementError {

    use ObjectTrait;

    /**
     * Source
     *
     * Error source, must be unspecified
     * @var string|null
     */
    protected ?string $source = null;

    /**
     * Type
     *
     * Type of element of the user's Telegram Passport which has the issue
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Element Hash
     *
     * Base64-encoded element hash
     * @var string|null
     */
    protected ?string $elementHash = null;

    /**
     * Message
     *
     * Error message
     * @var string|null
     */
    protected ?string $message = null;

    public static function fromArray(array $data): PassportElementErrorUnspecified {
        $instance = new self();
        if (isset($data['source'])) {
            $instance->source = $data['source'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['element_hash'])) {
            $instance->elementHash = $data['element_hash'];
        }
        if (isset($data['message'])) {
            $instance->message = $data['message'];
        }
        return $instance;
    }

    public function __construct(
        ?string $source = null,
        ?string $type = null,
        ?string $elementHash = null,
        ?string $message = null,
    ) {
        $this->source = $source;
        $this->type = $type;
        $this->elementHash = $elementHash;
        $this->message = $message;
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

    public function getElementHash(): ?string {
        return $this->elementHash;
    }

    public function setElementHash(?string $value): self {
        $this->elementHash = $value;
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
