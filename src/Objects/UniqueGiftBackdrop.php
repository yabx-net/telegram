<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the backdrop of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftbackdrop
 */
final class UniqueGiftBackdrop extends AbstractObject {

    /**
     * Name
     *
     * Name of the backdrop
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Colors
     *
     * Colors of the backdrop
     * @var UniqueGiftBackdropColors|null
     */
    protected ?UniqueGiftBackdropColors $colors = null;

    /**
     * Rarity Per Mille
     *
     * The number of unique gifts that receive this backdrop for every 1000 gifts upgraded
     * @var int|null
     */
    protected ?int $rarityPerMille = null;

    public static function fromArray(array $data): UniqueGiftBackdrop {
        $instance = new self();
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['colors'])) {
            $instance->colors = UniqueGiftBackdropColors::fromArray($data['colors']);
        }
        if (isset($data['rarity_per_mille'])) {
            $instance->rarityPerMille = $data['rarity_per_mille'];
        }
        return $instance;
    }

    public function __construct(
        ?string $name = null,
        ?UniqueGiftBackdropColors $colors = null,
        ?int $rarityPerMille = null,
    ) {
        $this->name = $name;
        $this->colors = $colors;
        $this->rarityPerMille = $rarityPerMille;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getColors(): ?UniqueGiftBackdropColors {
        return $this->colors;
    }

    public function setColors(?UniqueGiftBackdropColors $value): self {
        $this->colors = $value;
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
