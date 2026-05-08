<?php

namespace Yabx\Telegram\Objects;

/**
 * Contains parameters of a post that is being suggested by the bot.
 * @link https://core.telegram.org/bots/api#suggestedpostparameters
 */
final class SuggestedPostParameters extends AbstractObject {

    /**
     * Price
     *
     * Optional. Proposed price for the post. If the field is omitted, then the post is unpaid.
     * @var SuggestedPostPrice|null
     */
    protected ?SuggestedPostPrice $price = null;

    /**
     * Send Date
     *
     * Optional. Proposed send date of the post. If specified, then the date must be between 300 second and 2678400 seconds (30 days) in the future. If the field is omitted, then the post can be published at any time within 30 days at the sole discretion of the user who approves it.
     * @var int|null
     */
    protected ?int $sendDate = null;

    public static function fromArray(array $data): SuggestedPostParameters {
        $instance = new self();
        if (isset($data['price'])) {
            $instance->price = SuggestedPostPrice::fromArray($data['price']);
        }
        if (isset($data['send_date'])) {
            $instance->sendDate = $data['send_date'];
        }
        return $instance;
    }

    public function __construct(
        ?SuggestedPostPrice $price = null,
        ?int $sendDate = null,
    ) {
        $this->price = $price;
        $this->sendDate = $sendDate;
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
