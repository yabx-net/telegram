<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes a sticker on a TON wallet card.
 * @link https://core.telegram.org/bots/api#tonwalletcardsticker
 */
final class TonWalletCardSticker extends AbstractObject {

    /**
     * Position
     *
     * Position of the sticker on the card
     * @var AreaPosition|null
     */
    protected ?AreaPosition $position = null;

    /**
     * Nft
     *
     * The NFT shown as the sticker
     * @var TonNft|null
     */
    protected ?TonNft $nft = null;

    public function __construct(
        ?AreaPosition $position = null,
        ?TonNft $nft = null
    ) {
        $this->position = $position;
        $this->nft = $nft;
    }

    public static function fromArray(array $data): TonWalletCardSticker {
        $instance = new self();
        if (isset($data['position'])) {
            $instance->position = AreaPosition::fromArray($data['position']);
        }
        if (isset($data['nft'])) {
            $instance->nft = TonNft::fromArray($data['nft']);
        }
        return $instance;
    }

    public function getPosition(): ?AreaPosition {
        return $this->position;
    }

    public function setPosition(?AreaPosition $value): self {
        $this->position = $value;
        return $this;
    }

    public function getNft(): ?TonNft {
        return $this->nft;
    }

    public function setNft(?TonNft $value): self {
        $this->nft = $value;
        return $this;
    }
}
