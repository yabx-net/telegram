<?php

namespace Yabx\Telegram\Objects;

final class Contact extends AbstractObject {

    /**
     * Phone Number
     *
     * Contact's phone number
     * @var string|null
     */
    protected ?string $phoneNumber = null;

    /**
     * First Name
     *
     * Contact's first name
     * @var string|null
     */
    protected ?string $firstName = null;

    /**
     * Last Name
     *
     * Optional. Contact's last name
     * @var string|null
     */
    protected ?string $lastName = null;

    /**
     * User Id
     *
     * Optional. Contact's user identifier in Telegram. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $userId = null;

    /**
     * Vcard
     *
     * Optional. Additional data about the contact in the form of a vCard
     * @var string|null
     */
    protected ?string $vcard = null;

    public function __construct(
        ?string $phoneNumber = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?int    $userId = null,
        ?string $vcard = null,
    ) {
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userId = $userId;
        $this->vcard = $vcard;
    }

    public static function fromArray(array $data): Contact {
        $instance = new self();
        if (isset($data['phone_number'])) {
            $instance->phoneNumber = $data['phone_number'];
        }
        if (isset($data['first_name'])) {
            $instance->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $instance->lastName = $data['last_name'];
        }
        if (isset($data['user_id'])) {
            $instance->userId = $data['user_id'];
        }
        if (isset($data['vcard'])) {
            $instance->vcard = $data['vcard'];
        }
        return $instance;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $value): self {
        $this->phoneNumber = $value;
        return $this;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(?string $value): self {
        $this->firstName = $value;
        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(?string $value): self {
        $this->lastName = $value;
        return $this;
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $value): self {
        $this->userId = $value;
        return $this;
    }

    public function getVcard(): ?string {
        return $this->vcard;
    }

    public function setVcard(?string $value): self {
        $this->vcard = $value;
        return $this;
    }

}
