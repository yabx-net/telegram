<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the symbol shown on the pattern of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftsymbol
 */
final class UniqueGiftSymbol extends AbstractObject {

    /**
     * Name
     *
     * Name of the symbol
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
     * The number of unique gifts that receive this model for every 1000 gifts upgraded
     * @var int|null
     */
    protected ?int $rarityPerMille = null;

    public static function fromArray(array $data): UniqueGiftSymbol {
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
        return $instance;
    }

    public function __construct(
        ?string $name = null,
        ?Sticker $sticker = null,
        ?int $rarityPerMille = null,
    ) {
        $this->name = $name;
        $this->sticker = $sticker;
        $this->rarityPerMille = $rarityPerMille;
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

}
