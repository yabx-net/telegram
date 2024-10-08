<?php

namespace Yabx\Telegram\Objects;

final class InputContactMessageContent extends AbstractObject {

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
     * Vcard
     *
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @var string|null
     */
    protected ?string $vcard = null;

    public function __construct(
        ?string $phoneNumber = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $vcard = null,
    ) {
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->vcard = $vcard;
    }

    public static function fromArray(array $data): InputContactMessageContent {
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

    public function getVcard(): ?string {
        return $this->vcard;
    }

    public function setVcard(?string $value): self {
        $this->vcard = $value;
        return $this;
    }

}
