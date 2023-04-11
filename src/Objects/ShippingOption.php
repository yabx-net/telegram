<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ShippingOption {

    use ObjectTrait;

    /**
     * Id
     *
     * Shipping option identifier
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Title
     *
     * Option title
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Prices
     *
     * List of price portions
     * @var LabeledPrice[]|null
     */
    protected ?array $prices = null;

    public function __construct(
        ?string $id = null,
        ?string $title = null,
        ?array  $prices = null,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->prices = $prices;
    }

    public static function fromArray(array $data): ShippingOption {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['prices'])) {
            $instance->prices = [];
            foreach ($data['prices'] as $item) {
                $instance->prices[] = LabeledPrice::fromArray($item);
            }
        }
        return $instance;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getPrices(): ?array {
        return $this->prices;
    }

    public function setPrices(?array $value): self {
        $this->prices = $value;
        return $this;
    }

}
