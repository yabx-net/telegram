<?php

namespace Yabx\Telegram\Objects;

class ShippingOption {

    /**
     * Id
     *
     * Shipping option identifier
     * @var string
     */
    protected string $id;

    /**
     * Title
     *
     * Option title
     * @var string
     */
    protected string $title;

    /**
     * Prices
     *
     * List of price portions
     * @var LabeledPrice[]
     */
    protected array $prices;


    public function __construct(array $data) {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['prices'])) {
            $this->prices = [];
            foreach ($data['prices'] as $item) {
                $this->prices[] = new LabeledPrice($item);
            }
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPrices(): array {
        return $this->prices;
    }


}
