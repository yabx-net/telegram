<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents an NFT in the TON blockchain.
 * @link https://core.telegram.org/bots/api#tonnft
 */
final class TonNft extends AbstractObject {

    /**
     * Address
     *
     * Address of the NFT
     * @var string|null
     */
    protected ?string $address = null;

    /**
     * Collection Address
     *
     * Optional. Address of the collection to which the NFT belongs; omitted if unknown
     * @var string|null
     */
    protected ?string $collectionAddress = null;

    /**
     * Index
     *
     * Index of the NFT among all NFTs from the collection as a decimal number
     * @var string|null
     */
    protected ?string $index = null;

    /**
     * Name
     *
     * Name of the NFT
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Description
     *
     * Description of the NFT
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Attributes
     *
     * Optional. Attributes of the NFT
     * @var array|null
     */
    protected ?array $attributes = null;

    /**
     * Gift
     *
     * Optional. The unique gift corresponding to the NFT
     * @var UniqueGift|null
     */
    protected ?UniqueGift $gift = null;

    public function __construct(
        ?string $address = null,
        ?string $collectionAddress = null,
        ?string $index = null,
        ?string $name = null,
        ?string $description = null,
        ?array $attributes = null,
        ?UniqueGift $gift = null
    ) {
        $this->address = $address;
        $this->collectionAddress = $collectionAddress;
        $this->index = $index;
        $this->name = $name;
        $this->description = $description;
        $this->attributes = $attributes;
        $this->gift = $gift;
    }

    public static function fromArray(array $data): TonNft {
        $instance = new self();
        if (isset($data['address'])) {
            $instance->address = $data['address'];
        }
        if (isset($data['collection_address'])) {
            $instance->collectionAddress = $data['collection_address'];
        }
        if (isset($data['index'])) {
            $instance->index = $data['index'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['attributes'])) {
            $instance->attributes = TonNftAttribute::arrayOf($data['attributes']);
        }
        if (isset($data['gift'])) {
            $instance->gift = UniqueGift::fromArray($data['gift']);
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

    public function getCollectionAddress(): ?string {
        return $this->collectionAddress;
    }

    public function setCollectionAddress(?string $value): self {
        $this->collectionAddress = $value;
        return $this;
    }

    public function getIndex(): ?string {
        return $this->index;
    }

    public function setIndex(?string $value): self {
        $this->index = $value;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
        return $this;
    }

    public function getAttributes(): ?array {
        return $this->attributes;
    }

    public function setAttributes(?array $value): self {
        $this->attributes = $value;
        return $this;
    }

    public function getGift(): ?UniqueGift {
        return $this->gift;
    }

    public function setGift(?UniqueGift $value): self {
        $this->gift = $value;
        return $this;
    }
}
