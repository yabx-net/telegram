<?php

namespace Yabx\Telegram\Objects;

final class Gifts extends AbstractObject {

    /**
     * Gifts
     *
     * The list of gifts
     * @var Gift[]|null
     */
    protected ?array $gifts = null;

    public static function fromArray(array $data): Gifts {
        $instance = new self();
        if (isset($data['gifts'])) {
            $instance->gifts = [];
            foreach ($data['gifts'] as $item) {
                $instance->gifts[] = Gift::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?array $gifts = null,
    ) {
        $this->gifts = $gifts;
    }

    public function getGifts(): ?array {
        return $this->gifts;
    }

    public function setGifts(?array $value): self {
        $this->gifts = $value;
        return $this;
    }

}
