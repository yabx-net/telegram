<?php

namespace Yabx\Telegram\Objects;

class EncryptedCredentials {

    /**
     * Data
     *
     * Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
     * @var string
     */
    protected string $data;

    /**
     * Hash
     *
     * Base64-encoded data hash for data authentication
     * @var string
     */
    protected string $hash;

    /**
     * Secret
     *
     * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
     * @var string
     */
    protected string $secret;


    public function __construct(array $data) {
        if (isset($data['data'])) {
            $this->data = $data['data'];
        }
        if (isset($data['hash'])) {
            $this->hash = $data['hash'];
        }
        if (isset($data['secret'])) {
            $this->secret = $data['secret'];
        }
    }

    public function getData(): string {
        return $this->data;
    }

    public function getHash(): string {
        return $this->hash;
    }

    public function getSecret(): string {
        return $this->secret;
    }


}
