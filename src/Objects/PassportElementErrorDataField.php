<?php

namespace Yabx\Telegram\Objects;

class PassportElementErrorDataField {

    /**
     * Source
     *
     * Error source, must be data
     * @var string
     */
    protected string $source;

    /**
     * Type
     *
     * The section of the user's Telegram Passport which has the error, one of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”
     * @var string
     */
    protected string $type;

    /**
     * Field Name
     *
     * Name of the data field which has the error
     * @var string
     */
    protected string $fieldName;

    /**
     * Data Hash
     *
     * Base64-encoded data hash
     * @var string
     */
    protected string $dataHash;

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
        if (isset($data['field_name'])) {
            $this->fieldName = $data['field_name'];
        }
        if (isset($data['data_hash'])) {
            $this->dataHash = $data['data_hash'];
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

    public function getFieldName(): string {
        return $this->fieldName;
    }

    public function getDataHash(): string {
        return $this->dataHash;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
