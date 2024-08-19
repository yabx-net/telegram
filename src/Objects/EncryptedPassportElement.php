<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class EncryptedPassportElement {

    use ObjectTrait;

    /**
     * Type
     *
     * Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”.
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Data
     *
     * Optional. Base64-encoded encrypted Telegram Passport element data provided by the user; available only for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var string|null
     */
    protected ?string $data = null;

    /**
     * Phone Number
     *
     * Optional. User's verified phone number; available only for “phone_number” type
     * @var string|null
     */
    protected ?string $phoneNumber = null;

    /**
     * Email
     *
     * Optional. User's verified email address; available only for “email” type
     * @var string|null
     */
    protected ?string $email = null;

    /**
     * Files
     *
     * Optional. Array of encrypted files with documents provided by the user; available only for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile[]|null
     */
    protected ?array $files = null;

    /**
     * Front Side
     *
     * Optional. Encrypted file with the front side of the document, provided by the user; available only for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile|null
     */
    protected ?PassportFile $frontSide = null;

    /**
     * Reverse Side
     *
     * Optional. Encrypted file with the reverse side of the document, provided by the user; available only for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile|null
     */
    protected ?PassportFile $reverseSide = null;

    /**
     * Selfie
     *
     * Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available if requested for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile|null
     */
    protected ?PassportFile $selfie = null;

    /**
     * Translation
     *
     * Optional. Array of encrypted files with translated versions of documents provided by the user; available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile[]|null
     */
    protected ?array $translation = null;

    /**
     * Hash
     *
     * Base64-encoded element hash for using in PassportElementErrorUnspecified
     * @var string|null
     */
    protected ?string $hash = null;

    public static function fromArray(array $data): EncryptedPassportElement {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['data'])) {
            $instance->data = $data['data'];
        }
        if (isset($data['phone_number'])) {
            $instance->phoneNumber = $data['phone_number'];
        }
        if (isset($data['email'])) {
            $instance->email = $data['email'];
        }
        if (isset($data['files'])) {
            $instance->files = [];
            foreach ($data['files'] as $item) {
                $instance->files[] = PassportFile::fromArray($item);
            }
        }
        if (isset($data['front_side'])) {
            $instance->frontSide = PassportFile::fromArray($data['front_side']);
        }
        if (isset($data['reverse_side'])) {
            $instance->reverseSide = PassportFile::fromArray($data['reverse_side']);
        }
        if (isset($data['selfie'])) {
            $instance->selfie = PassportFile::fromArray($data['selfie']);
        }
        if (isset($data['translation'])) {
            $instance->translation = [];
            foreach ($data['translation'] as $item) {
                $instance->translation[] = PassportFile::fromArray($item);
            }
        }
        if (isset($data['hash'])) {
            $instance->hash = $data['hash'];
        }
        return $instance;
    }

    public function __construct(
        ?string       $type = null,
        ?string       $data = null,
        ?string       $phoneNumber = null,
        ?string       $email = null,
        ?array        $files = null,
        ?PassportFile $frontSide = null,
        ?PassportFile $reverseSide = null,
        ?PassportFile $selfie = null,
        ?array        $translation = null,
        ?string       $hash = null,
    ) {
        $this->type = $type;
        $this->data = $data;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->files = $files;
        $this->frontSide = $frontSide;
        $this->reverseSide = $reverseSide;
        $this->selfie = $selfie;
        $this->translation = $translation;
        $this->hash = $hash;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function setData(?string $value): self {
        $this->data = $value;
        return $this;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $value): self {
        $this->phoneNumber = $value;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $value): self {
        $this->email = $value;
        return $this;
    }

    public function getFiles(): ?array {
        return $this->files;
    }

    public function setFiles(?array $value): self {
        $this->files = $value;
        return $this;
    }

    public function getFrontSide(): ?PassportFile {
        return $this->frontSide;
    }

    public function setFrontSide(?PassportFile $value): self {
        $this->frontSide = $value;
        return $this;
    }

    public function getReverseSide(): ?PassportFile {
        return $this->reverseSide;
    }

    public function setReverseSide(?PassportFile $value): self {
        $this->reverseSide = $value;
        return $this;
    }

    public function getSelfie(): ?PassportFile {
        return $this->selfie;
    }

    public function setSelfie(?PassportFile $value): self {
        $this->selfie = $value;
        return $this;
    }

    public function getTranslation(): ?array {
        return $this->translation;
    }

    public function setTranslation(?array $value): self {
        $this->translation = $value;
        return $this;
    }

    public function getHash(): ?string {
        return $this->hash;
    }

    public function setHash(?string $value): self {
        $this->hash = $value;
        return $this;
    }

}
