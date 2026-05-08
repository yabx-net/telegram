<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about the rejection of a suggested post.
 * @link https://core.telegram.org/bots/api#suggestedpostdeclined
 */
final class SuggestedPostDeclined extends AbstractObject {

    /**
     * Suggested Post Message
     *
     * Optional. Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $suggestedPostMessage = null;

    /**
     * Comment
     *
     * Optional. Comment with which the post was declined
     * @var string|null
     */
    protected ?string $comment = null;

    public static function fromArray(array $data): SuggestedPostDeclined {
        $instance = new self();
        if (isset($data['suggested_post_message'])) {
            $instance->suggestedPostMessage = Message::fromArray($data['suggested_post_message']);
        }
        if (isset($data['comment'])) {
            $instance->comment = $data['comment'];
        }
        return $instance;
    }

    public function __construct(
        ?Message $suggestedPostMessage = null,
        ?string $comment = null,
    ) {
        $this->suggestedPostMessage = $suggestedPostMessage;
        $this->comment = $comment;
    }

    public function getSuggestedPostMessage(): ?Message {
        return $this->suggestedPostMessage;
    }

    public function setSuggestedPostMessage(?Message $value): self {
        $this->suggestedPostMessage = $value;
        return $this;
    }

    public function getComment(): ?string {
        return $this->comment;
    }

    public function setComment(?string $value): self {
        $this->comment = $value;
        return $this;
    }

}
