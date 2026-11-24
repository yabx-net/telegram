<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents an attribute of an NFT in the TON blockchain.
 * @link https://core.telegram.org/bots/api#tonnftattribute
 */
final class TonNftAttribute extends AbstractObject {

    /**
     * Trait Type
     *
     * Trait type of the attribute
     * @var string|null
     */
    protected ?string $traitType = null;

    /**
     * Value
     *
     * Value of the attribute
     * @var string|null
     */
    protected ?string $value = null;

    public function __construct(
        ?string $traitType = null,
        ?string $value = null
    ) {
        $this->traitType = $traitType;
        $this->value = $value;
    }

    public static function fromArray(array $data): TonNftAttribute {
        $instance = new self();
        if (isset($data['trait_type'])) {
            $instance->traitType = $data['trait_type'];
        }
        if (isset($data['value'])) {
            $instance->value = $data['value'];
        }
        return $instance;
    }

    public function getTraitType(): ?string {
        return $this->traitType;
    }

    public function setTraitType(?string $value): self {
        $this->traitType = $value;
        return $this;
    }

    public function getValue(): ?string {
        return $this->value;
    }

    public function setValue(?string $value): self {
        $this->value = $value;
        return $this;
    }

}
