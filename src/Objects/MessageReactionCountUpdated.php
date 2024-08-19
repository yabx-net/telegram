<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MessageReactionCountUpdated {

    use ObjectTrait;

    /**
     * Chat
     *
     * The chat containing the message
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Message Id
     *
     * Unique message identifier inside the chat
     * @var int|null
     */
    protected ?int $messageId = null;

    /**
     * Date
     *
     * Date of the change in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Reactions
     *
     * List of reactions that are present on the message
     * @var ReactionCount[]|null
     */
    protected ?array $reactions = null;

    public static function fromArray(array $data): MessageReactionCountUpdated {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['reactions'])) {
            $instance->reactions = [];
            foreach ($data['reactions'] as $item) {
                $instance->reactions[] = ReactionCount::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?Chat  $chat = null,
        ?int   $messageId = null,
        ?int   $date = null,
        ?array $reactions = null,
    ) {
        $this->chat = $chat;
        $this->messageId = $messageId;
        $this->date = $date;
        $this->reactions = $reactions;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getReactions(): ?array {
        return $this->reactions;
    }

    public function setReactions(?array $value): self {
        $this->reactions = $value;
        return $this;
    }

}
