<?php

namespace Yabx\Telegram\Objects;

class InputContactMessageContent {

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
     * Vcard
     *
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @var string|null
     */
    protected ?string $vcard = null;


    public function __construct(array $data) {
        if (isset($data['phone_number'])) {
            $this->phoneNumber = $data['phone_number'];
        }
        if (isset($data['first_name'])) {
            $this->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $this->lastName = $data['last_name'];
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

    public function getVcard(): ?string {
        return $this->vcard;
    }


}
