<?php

namespace Yabx\Telegram\Objects;

class EncryptedPassportElement {

    /**
     * Type
     *
     * Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”.
     * @var string
     */
    protected string $type;

    /**
     * Data
     *
     * Optional. Base64-encoded encrypted Telegram Passport element data provided by the user, available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var string|null
     */
    protected ?string $data = null;

    /**
     * Phone Number
     *
     * Optional. User's verified phone number, available only for “phone_number” type
     * @var string|null
     */
    protected ?string $phoneNumber = null;

    /**
     * Email
     *
     * Optional. User's verified email address, available only for “email” type
     * @var string|null
     */
    protected ?string $email = null;

    /**
     * Files
     *
     * Optional. Array of encrypted files with documents provided by the user, available for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile[]|null
     */
    protected ?array $files = null;

    /**
     * Front Side
     *
     * Optional. Encrypted file with the front side of the document, provided by the user. Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile|null
     */
    protected ?PassportFile $frontSide = null;

    /**
     * Reverse Side
     *
     * Optional. Encrypted file with the reverse side of the document, provided by the user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile|null
     */
    protected ?PassportFile $reverseSide = null;

    /**
     * Selfie
     *
     * Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile|null
     */
    protected ?PassportFile $selfie = null;

    /**
     * Translation
     *
     * Optional. Array of encrypted files with translated versions of documents provided by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFile[]|null
     */
    protected ?array $translation = null;

    /**
     * Hash
     *
     * Base64-encoded element hash for using in PassportElementErrorUnspecified
     * @var string
     */
    protected string $hash;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['data'])) {
            $this->data = $data['data'];
        }
        if (isset($data['phone_number'])) {
            $this->phoneNumber = $data['phone_number'];
        }
        if (isset($data['email'])) {
            $this->email = $data['email'];
        }
        if (isset($data['files'])) {
            $this->files = [];
            foreach ($data['files'] as $item) {
                $this->files[] = new PassportFile($item);
            }
        }
        if (isset($data['front_side'])) {
            $this->frontSide = new PassportFile($data['front_side']);
        }
        if (isset($data['reverse_side'])) {
            $this->reverseSide = new PassportFile($data['reverse_side']);
        }
        if (isset($data['selfie'])) {
            $this->selfie = new PassportFile($data['selfie']);
        }
        if (isset($data['translation'])) {
            $this->translation = [];
            foreach ($data['translation'] as $item) {
                $this->translation[] = new PassportFile($item);
            }
        }
        if (isset($data['hash'])) {
            $this->hash = $data['hash'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getFiles(): ?array {
        return $this->files;
    }

    public function getFrontSide(): ?PassportFile {
        return $this->frontSide;
    }

    public function getReverseSide(): ?PassportFile {
        return $this->reverseSide;
    }

    public function getSelfie(): ?PassportFile {
        return $this->selfie;
    }

    public function getTranslation(): ?array {
        return $this->translation;
    }

    public function getHash(): string {
        return $this->hash;
    }


}
