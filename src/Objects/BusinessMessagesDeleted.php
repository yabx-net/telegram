<?php

namespace Yabx\Telegram\Objects;

final class BusinessMessagesDeleted extends AbstractObject {

    /**
     * Business Connection Id
     *
     * Unique identifier of the business connection
     * @var string|null
     */
    protected ?string $businessConnectionId = null;

    /**
     * Chat
     *
     * Information about a chat in the business account. The bot may not have access to the chat or the corresponding user.
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Message Ids
     *
     * The list of identifiers of deleted messages in the chat of the business account
     * @var int[]|null
     */
    protected ?array $messageIds = null;

    public function __construct(
        ?string $businessConnectionId = null,
        ?Chat   $chat = null,
        ?array  $messageIds = null,
    ) {
        $this->businessConnectionId = $businessConnectionId;
        $this->chat = $chat;
        $this->messageIds = $messageIds;
    }

    public static function fromArray(array $data): BusinessMessagesDeleted {
        $instance = new self();
        if (isset($data['business_connection_id'])) {
            $instance->businessConnectionId = $data['business_connection_id'];
        }
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_ids'])) {
            $instance->messageIds = [];
            foreach ($data['message_ids'] as $item) {
                $instance->messageIds[] = $item;
            }
        }
        return $instance;
    }

    public function getBusinessConnectionId(): ?string {
        return $this->businessConnectionId;
    }

    public function setBusinessConnectionId(?string $value): self {
        $this->businessConnectionId = $value;
        return $this;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getMessageIds(): ?array {
        return $this->messageIds;
    }

    public function setMessageIds(?array $value): self {
        $this->messageIds = $value;
        return $this;
    }

}
