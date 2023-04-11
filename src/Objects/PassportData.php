<?php

namespace Yabx\Telegram\Objects;

class PassportData {

    /**
     * Data
     *
     * Array with information about documents and other Telegram Passport elements that was shared with the bot
     * @var EncryptedPassportElement[]
     */
    protected array $data;

    /**
     * Credentials
     *
     * Encrypted credentials required to decrypt the data
     * @var EncryptedCredentials
     */
    protected EncryptedCredentials $credentials;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['data'])) {
            $this->data = [];
            foreach ($data['data'] as $item) {
                $this->data[] = new EncryptedPassportElement($item);
            }
        }
        if (isset($data['credentials'])) {
            $this->credentials = new EncryptedCredentials($data['credentials']);
        }
    }

    public function getData(): array {
        return $this->data;
    }

    public function getCredentials(): EncryptedCredentials {
        return $this->credentials;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
