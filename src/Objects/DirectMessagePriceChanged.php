<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a change in the price of direct messages sent to a channel chat.
 * @link https://core.telegram.org/bots/api#directmessagepricechanged
 */
final class DirectMessagePriceChanged extends AbstractObject {

    /**
     * Are Direct Messages Enabled
     *
     * True, if direct messages are enabled for the channel chat; false otherwise
     * @var bool|null
     */
    protected ?bool $areDirectMessagesEnabled = null;

    /**
     * Direct Message Star Count
     *
     * Optional. The new number of Telegram Stars that must be paid by users for each direct message sent to the channel. Does not apply to users who have been exempted by administrators. Defaults to 0.
     * @var int|null
     */
    protected ?int $directMessageStarCount = null;

    public static function fromArray(array $data): DirectMessagePriceChanged {
        $instance = new self();
        if (isset($data['are_direct_messages_enabled'])) {
            $instance->areDirectMessagesEnabled = $data['are_direct_messages_enabled'];
        }
        if (isset($data['direct_message_star_count'])) {
            $instance->directMessageStarCount = $data['direct_message_star_count'];
        }
        return $instance;
    }

    public function __construct(
        ?bool $areDirectMessagesEnabled = null,
        ?int $directMessageStarCount = null,
    ) {
        $this->areDirectMessagesEnabled = $areDirectMessagesEnabled;
        $this->directMessageStarCount = $directMessageStarCount;
    }

    public function getAreDirectMessagesEnabled(): ?bool {
        return $this->areDirectMessagesEnabled;
    }

    public function setAreDirectMessagesEnabled(?bool $value): self {
        $this->areDirectMessagesEnabled = $value;
        return $this;
    }

    public function getDirectMessageStarCount(): ?int {
        return $this->directMessageStarCount;
    }

    public function setDirectMessageStarCount(?int $value): self {
        $this->directMessageStarCount = $value;
        return $this;
    }

}
