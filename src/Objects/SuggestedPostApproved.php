<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about the approval of a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostapproved
 */
final class SuggestedPostApproved extends AbstractObject {

    /**
     * Suggested Post Message
     *
     * Optional. Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $suggestedPostMessage = null;

    /**
     * Price
     *
     * Optional. Amount paid for the post
     * @var SuggestedPostPrice|null
     */
    protected ?SuggestedPostPrice $price = null;

    /**
     * Send Date
     *
     * Date when the post will be published
     * @var int|null
     */
    protected ?int $sendDate = null;

    public static function fromArray(array $data): SuggestedPostApproved {
        $instance = new self();
        if (isset($data['suggested_post_message'])) {
            $instance->suggestedPostMessage = Message::fromArray($data['suggested_post_message']);
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
        ?Message $suggestedPostMessage = null,
        ?SuggestedPostPrice $price = null,
        ?int $sendDate = null,
    ) {
        $this->suggestedPostMessage = $suggestedPostMessage;
        $this->price = $price;
        $this->sendDate = $sendDate;
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

    public function getSendDate(): ?int {
        return $this->sendDate;
    }

    public function setSendDate(?int $value): self {
        $this->sendDate = $value;
        return $this;
    }

}
