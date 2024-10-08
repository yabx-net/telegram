<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class EncryptedCredentials {

    use ObjectTrait;

    /**
     * Data
     *
     * Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
     * @var string|null
     */
    protected ?string $data = null;

    /**
     * Hash
     *
     * Base64-encoded data hash for data authentication
     * @var string|null
     */
    protected ?string $hash = null;

    /**
     * Secret
     *
     * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
     * @var string|null
     */
    protected ?string $secret = null;

    public function __construct(
        ?string $data = null,
        ?string $hash = null,
        ?string $secret = null,
    ) {
        $this->data = $data;
        $this->hash = $hash;
        $this->secret = $secret;
    }

    public static function fromArray(array $data): EncryptedCredentials {
        $instance = new self();
        if (isset($data['data'])) {
            $instance->data = $data['data'];
        }
        if (isset($data['hash'])) {
            $instance->hash = $data['hash'];
        }
        if (isset($data['secret'])) {
            $instance->secret = $data['secret'];
        }
        return $instance;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function setData(?string $value): self {
        $this->data = $value;
        return $this;
    }

    public function getHash(): ?string {
        return $this->hash;
    }

    public function setHash(?string $value): self {
        $this->hash = $value;
        return $this;
    }

    public function getSecret(): ?string {
        return $this->secret;
    }

    public function setSecret(?string $value): self {
        $this->secret = $value;
        return $this;
    }

}
