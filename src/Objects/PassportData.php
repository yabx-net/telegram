<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PassportData {

    use ObjectTrait;

    /**
     * Data
     *
     * Array with information about documents and other Telegram Passport elements that was shared with the bot
     * @var EncryptedPassportElement[]|null
     */
    protected ?array $data = null;

    /**
     * Credentials
     *
     * Encrypted credentials required to decrypt the data
     * @var EncryptedCredentials|null
     */
    protected ?EncryptedCredentials $credentials = null;

    public function __construct(
        ?array                $data = null,
        ?EncryptedCredentials $credentials = null,
    ) {
        $this->data = $data;
        $this->credentials = $credentials;
    }

    public static function fromArray(array $data): PassportData {
        $instance = new self();
        if (isset($data['data'])) {
            $instance->data = [];
            foreach ($data['data'] as $item) {
                $instance->data[] = EncryptedPassportElement::fromArray($item);
            }
        }
        if (isset($data['credentials'])) {
            $instance->credentials = EncryptedCredentials::fromArray($data['credentials']);
        }
        return $instance;
    }

    public function getData(): ?array {
        return $this->data;
    }

    public function setData(?array $value): self {
        $this->data = $value;
        return $this;
    }

    public function getCredentials(): ?EncryptedCredentials {
        return $this->credentials;
    }

    public function setCredentials(?EncryptedCredentials $value): self {
        $this->credentials = $value;
        return $this;
    }

}
