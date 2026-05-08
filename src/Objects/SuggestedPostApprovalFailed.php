<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about the failed approval of a suggested post. Currently, only caused by insufficient user funds at the time of approval.
 * @link https://core.telegram.org/bots/api#suggestedpostapprovalfailed
 */
final class SuggestedPostApprovalFailed extends AbstractObject {

    /**
     * Suggested Post Message
     *
     * Optional. Message containing the suggested post whose approval has failed. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $suggestedPostMessage = null;

    /**
     * Price
     *
     * Expected price of the post
     * @var SuggestedPostPrice|null
     */
    protected ?SuggestedPostPrice $price = null;

    public static function fromArray(array $data): SuggestedPostApprovalFailed {
        $instance = new self();
        if (isset($data['suggested_post_message'])) {
            $instance->suggestedPostMessage = Message::fromArray($data['suggested_post_message']);
        }
        if (isset($data['price'])) {
            $instance->price = SuggestedPostPrice::fromArray($data['price']);
        }
        return $instance;
    }

    public function __construct(
        ?Message $suggestedPostMessage = null,
        ?SuggestedPostPrice $price = null,
    ) {
        $this->suggestedPostMessage = $suggestedPostMessage;
        $this->price = $price;
    }

    public function getSuggestedPostMessage(): ?Message {
        return $this->suggestedPostMessage;
    }

    public function setSuggestedPostMessage(?Message $value): self {
        $this->suggestedPostMessage = $value;
        return $this;
    }

    public function getPrice(): ?SuggestedPostPrice {
        return $this->price;
    }

    public function setPrice(?SuggestedPostPrice $value): self {
        $this->price = $value;
        return $this;
    }

}
