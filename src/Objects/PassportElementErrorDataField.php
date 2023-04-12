<?php

namespace Yabx\Telegram\Objects;

final class PassportElementErrorDataField extends PassportElementError {

    /**
     * Source
     *
     * Error source, must be data
     * @var string|null
     */
    protected ?string $source = null;

    /**
     * Type
     *
     * The section of the user's Telegram Passport which has the error, one of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Field Name
     *
     * Name of the data field which has the error
     * @var string|null
     */
    protected ?string $fieldName = null;

    /**
     * Data Hash
     *
     * Base64-encoded data hash
     * @var string|null
     */
    protected ?string $dataHash = null;

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
        ?string $fieldName = null,
        ?string $dataHash = null,
        ?string $message = null,
    ) {
        $this->source = $source;
        $this->type = $type;
        $this->fieldName = $fieldName;
        $this->dataHash = $dataHash;
        $this->message = $message;
    }

    public static function fromArray(array $data): PassportElementErrorDataField {
        $instance = new self();
        if (isset($data['source'])) {
            $instance->source = $data['source'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['field_name'])) {
            $instance->fieldName = $data['field_name'];
        }
        if (isset($data['data_hash'])) {
            $instance->dataHash = $data['data_hash'];
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

    public function getFieldName(): ?string {
        return $this->fieldName;
    }

    public function setFieldName(?string $value): self {
        $this->fieldName = $value;
        return $this;
    }

    public function getDataHash(): ?string {
        return $this->dataHash;
    }

    public function setDataHash(?string $value): self {
        $this->dataHash = $value;
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
