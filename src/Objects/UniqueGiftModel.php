<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the model of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftmodel
 */
final class UniqueGiftModel extends AbstractObject {

    /**
     * Name
     *
     * Name of the model
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Sticker
     *
     * The sticker that represents the unique gift
     * @var Sticker|null
     */
    protected ?Sticker $sticker = null;

    /**
     * Rarity Per Mille
     *
     * The number of unique gifts that receive this model for every 1000 gift upgrades. Always 0 for crafted gifts.
     * @var int|null
     */
    protected ?int $rarityPerMille = null;

    /**
     * Rarity
     *
     * Optional. Rarity of the model if it is a crafted model. Currently, can be “uncommon”, “rare”, “epic”, or “legendary”.
     * @var string|null
     */
    protected ?string $rarity = null;

    public static function fromArray(array $data): UniqueGiftModel {
        $instance = new self();
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['sticker'])) {
            $instance->sticker = Sticker::fromArray($data['sticker']);
        }
        if (isset($data['rarity_per_mille'])) {
            $instance->rarityPerMille = $data['rarity_per_mille'];
        }
        if (isset($data['rarity'])) {
            $instance->rarity = $data['rarity'];
        }
        return $instance;
    }

    public function __construct(
        ?string $name = null,
        ?Sticker $sticker = null,
        ?int $rarityPerMille = null,
        ?string $rarity = null,
    ) {
        $this->name = $name;
        $this->sticker = $sticker;
        $this->rarityPerMille = $rarityPerMille;
        $this->rarity = $rarity;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getSticker(): ?Sticker {
        return $this->sticker;
    }

    public function setSticker(?Sticker $value): self {
        $this->sticker = $value;
        return $this;
    }

    public function getRarityPerMille(): ?int {
        return $this->rarityPerMille;
    }

    public function setRarityPerMille(?int $value): self {
        $this->rarityPerMille = $value;
        return $this;
    }

    public function getRarity(): ?string {
        return $this->rarity;
    }

    public function setRarity(?string $value): self {
        $this->rarity = $value;
        return $this;
    }

}
