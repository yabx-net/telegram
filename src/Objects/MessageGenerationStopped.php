<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes an update about a user stopping message generation.
 * @link https://core.telegram.org/bots/api#messagegenerationstopped
 */
final class MessageGenerationStopped extends AbstractObject {

    /**
     * Chat
     *
     * Chat in which the message is generated
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Message Thread Id
     *
     * Optional. Unique identifier of the message thread in which the message is generated
     * @var int|null
     */
    protected ?int $messageThreadId = null;

    /**
     * Draft Id
     *
     * Unique identifier of the message draft which was stopped
     * @var int|null
     */
    protected ?int $draftId = null;

    public function __construct(
        ?Chat $chat = null,
        ?int $messageThreadId = null,
        ?int $draftId = null,
    ) {
        $this->chat = $chat;
        $this->messageThreadId = $messageThreadId;
        $this->draftId = $draftId;
    }

    public static function fromArray(array $data): MessageGenerationStopped {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_thread_id'])) {
            $instance->messageThreadId = $data['message_thread_id'];
        }
        if (isset($data['draft_id'])) {
            $instance->draftId = $data['draft_id'];
        }
        return $instance;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getMessageThreadId(): ?int {
        return $this->messageThreadId;
    }

    public function setMessageThreadId(?int $value): self {
        $this->messageThreadId = $value;
        return $this;
    }

    public function getDraftId(): ?int {
        return $this->draftId;
    }

    public function setDraftId(?int $value): self {
        $this->draftId = $value;
        return $this;
    }
}
