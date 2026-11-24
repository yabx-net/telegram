<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes a TON wallet of the user, which is used in a query from a widget.
 * @link https://core.telegram.org/bots/api#widgetquerywallet
 */
final class WidgetQueryWallet extends AbstractObject {

    /**
     * Address
     *
     * Address of the wallet
     * @var string|null
     */
    protected ?string $address = null;

    /**
     * Amount
     *
     * Balance of the wallet, in the smallest units of the cryptocurrency, as a decimal number
     * @var string|null
     */
    protected ?string $amount = null;

    /**
     * Public Key
     *
     * Optional. Hex-encoded public key of the wallet; omitted if unknown
     * @var string|null
     */
    protected ?string $publicKey = null;

    /**
     * State Init
     *
     * Optional. Base64-encoded serialized StateInit of the wallet contract; omitted if and only if public_key is omitted
     * @var string|null
     */
    protected ?string $stateInit = null;

    public function __construct(
        ?string $address = null,
        ?string $amount = null,
        ?string $publicKey = null,
        ?string $stateInit = null
    ) {
        $this->address = $address;
        $this->amount = $amount;
        $this->publicKey = $publicKey;
        $this->stateInit = $stateInit;
    }

    public static function fromArray(array $data): WidgetQueryWallet {
        $instance = new self();
        if (isset($data['address'])) {
            $instance->address = $data['address'];
        }
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        if (isset($data['public_key'])) {
            $instance->publicKey = $data['public_key'];
        }
        if (isset($data['state_init'])) {
            $instance->stateInit = $data['state_init'];
        }
        return $instance;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $value): self {
        $this->address = $value;
        return $this;
    }

    public function getAmount(): ?string {
        return $this->amount;
    }

    public function setAmount(?string $value): self {
        $this->amount = $value;
        return $this;
    }

    public function getPublicKey(): ?string {
        return $this->publicKey;
    }

    public function setPublicKey(?string $value): self {
        $this->publicKey = $value;
        return $this;
    }

    public function getStateInit(): ?string {
        return $this->stateInit;
    }

    public function setStateInit(?string $value): self {
        $this->stateInit = $value;
        return $this;
    }

}
