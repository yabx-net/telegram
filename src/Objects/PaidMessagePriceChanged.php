<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a change in the price of paid messages within a chat.
 * @link https://core.telegram.org/bots/api#paidmessagepricechanged
 */
final class PaidMessagePriceChanged extends AbstractObject {

    /**
     * Paid Message Star Count
     *
     * The new number of Telegram Stars that must be paid by non-administrator users of the supergroup chat for each sent message
     * @var int|null
     */
    protected ?int $paidMessageStarCount = null;

    public static function fromArray(array $data): PaidMessagePriceChanged {
        $instance = new self();
        if (isset($data['paid_message_star_count'])) {
            $instance->paidMessageStarCount = $data['paid_message_star_count'];
        }
        return $instance;
    }

    public function __construct(
        ?int $paidMessageStarCount = null,
    ) {
        $this->paidMessageStarCount = $paidMessageStarCount;
    }

    public function getPaidMessageStarCount(): ?int {
        return $this->paidMessageStarCount;
    }

    public function setPaidMessageStarCount(?int $value): self {
        $this->paidMessageStarCount = $value;
        return $this;
    }

}
