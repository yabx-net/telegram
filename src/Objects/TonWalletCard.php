<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes a TON wallet card, which is shown on the profile page of a user to everyone.
 * @link https://core.telegram.org/bots/api#tonwalletcard
 */
final class TonWalletCard extends AbstractObject {

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
     * Stickers
     *
     * Stickers placed on the card
     * @var array|null
     */
    protected ?array $stickers = null;

    /**
     * Background Nft Address
     *
     * Optional. Address of the NFT of one of the stickers, whose colors must be used for the card background; omitted if the default background must be used
     * @var string|null
     */
    protected ?string $backgroundNftAddress = null;

    public function __construct(
        ?string $address = null,
        ?string $amount = null,
        ?array $stickers = null,
        ?string $backgroundNftAddress = null
    ) {
        $this->address = $address;
        $this->amount = $amount;
        $this->stickers = $stickers;
        $this->backgroundNftAddress = $backgroundNftAddress;
    }

    public static function fromArray(array $data): TonWalletCard {
        $instance = new self();
        if (isset($data['address'])) {
            $instance->address = $data['address'];
        }
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        if (isset($data['stickers'])) {
            $instance->stickers = TonWalletCardSticker::arrayOf($data['stickers']);
        }
        if (isset($data['background_nft_address'])) {
            $instance->backgroundNftAddress = $data['background_nft_address'];
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

    public function getStickers(): ?array {
        return $this->stickers;
    }

    public function setStickers(?array $value): self {
        $this->stickers = $value;
        return $this;
    }

    public function getBackgroundNftAddress(): ?string {
        return $this->backgroundNftAddress;
    }

    public function setBackgroundNftAddress(?string $value): self {
        $this->backgroundNftAddress = $value;
        return $this;
    }
}
