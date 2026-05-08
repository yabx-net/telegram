<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a payment refund for a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostrefunded
 */
final class SuggestedPostRefunded extends AbstractObject {

    /**
     * Suggested Post Message
     *
     * Optional. Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $suggestedPostMessage = null;

    /**
     * Reason
     *
     * Reason for the refund. Currently, one of “post_deleted” if the post was deleted within 24 hours of being posted or removed from scheduled messages without being posted, or “payment_refunded” if the payer refunded their payment.
     * @var string|null
     */
    protected ?string $reason = null;

    public static function fromArray(array $data): SuggestedPostRefunded {
        $instance = new self();
        if (isset($data['suggested_post_message'])) {
            $instance->suggestedPostMessage = Message::fromArray($data['suggested_post_message']);
        }
        if (isset($data['reason'])) {
            $instance->reason = $data['reason'];
        }
        return $instance;
    }

    public function __construct(
        ?Message $suggestedPostMessage = null,
        ?string $reason = null,
    ) {
        $this->suggestedPostMessage = $suggestedPostMessage;
        $this->reason = $reason;
    }

    public function getSuggestedPostMessage(): ?Message {
        return $this->suggestedPostMessage;
    }

    public function setSuggestedPostMessage(?Message $value): self {
        $this->suggestedPostMessage = $value;
        return $this;
    }

    public function getReason(): ?string {
        return $this->reason;
    }

    public function setReason(?string $value): self {
        $this->reason = $value;
        return $this;
    }

}
