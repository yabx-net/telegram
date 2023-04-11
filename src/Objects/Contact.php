<?php

namespace Yabx\Telegram\Objects;

class Contact {

    /**
     * Phone Number
     *
     * Contact's phone number
     * @var string
     */
    protected string $phoneNumber;

    /**
     * First Name
     *
     * Contact's first name
     * @var string
     */
    protected string $firstName;

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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['phone_number'])) {
            $this->phoneNumber = $data['phone_number'];
        }
        if (isset($data['first_name'])) {
            $this->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $this->lastName = $data['last_name'];
        }
        if (isset($data['user_id'])) {
            $this->userId = $data['user_id'];
        }
        if (isset($data['vcard'])) {
            $this->vcard = $data['vcard'];
        }
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function getVcard(): ?string {
        return $this->vcard;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
