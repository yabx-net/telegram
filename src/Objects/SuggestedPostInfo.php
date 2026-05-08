<?php

namespace Yabx\Telegram\Objects;

/**
 * Contains information about a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostinfo
 */
final class SuggestedPostInfo extends AbstractObject {

    /**
     * State
     *
     * State of the suggested post. Currently, it can be one of “pending”, “approved”, “declined”.
     * @var string|null
     */
    protected ?string $state = null;

    /**
     * Price
     *
     * Optional. Proposed price of the post. If the field is omitted, then the post is unpaid.
     * @var SuggestedPostPrice|null
     */
    protected ?SuggestedPostPrice $price = null;

    /**
     * Send Date
     *
     * Optional. Proposed send date of the post. If the field is omitted, then the post can be published at any time within 30 days at the sole discretion of the user or administrator who approves it.
     * @var int|null
     */
    protected ?int $sendDate = null;

    public static function fromArray(array $data): SuggestedPostInfo {
        $instance = new self();
        if (isset($data['state'])) {
            $instance->state = $data['state'];
        }
        if (isset($data['price'])) {
            $instance->price = SuggestedPostPrice::fromArray($data['price']);
        }
        if (isset($data['send_date'])) {
            $instance->sendDate = $data['send_date'];
        }
        return $instance;
    }

    public function __construct(
        ?string $state = null,
        ?SuggestedPostPrice $price = null,
        ?int $sendDate = null,
    ) {
        $this->state = $state;
        $this->price = $price;
        $this->sendDate = $sendDate;
    }

    public function getState(): ?string {
        return $this->state;
    }

    public function setState(?string $value): self {
        $this->state = $value;
        return $this;
    }

    public function getPrice(): ?SuggestedPostPrice {
        return $this->price;
    }

    public function setPrice(?SuggestedPostPrice $value): self {
        $this->price = $value;
        return $this;
    }

    public function getSendDate(): ?int {
        return $this->sendDate;
    }

    public function setSendDate(?int $value): self {
        $this->sendDate = $value;
        return $this;
    }

}
