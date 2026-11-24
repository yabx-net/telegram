<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents an incoming query from a widget in a message sent by the bot or via the bot.
 * @link https://core.telegram.org/bots/api#widgetquery
 */
final class WidgetQuery extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier for this query
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * From
     *
     * Sender
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Chat
     *
     * Optional. Chat with the message containing the widget; omitted if the widget is in an inline message
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Message Id
     *
     * Optional. Identifier of the message containing the widget; omitted if the widget is in an inline message
     * @var int|null
     */
    protected ?int $messageId = null;

    /**
     * Inline Message Id
     *
     * Optional. Identifier of the inline message containing the widget
     * @var string|null
     */
    protected ?string $inlineMessageId = null;

    /**
     * Chat Instance
     *
     * Global identifier, uniquely corresponding to the chat to which the message with the widget was sent
     * @var string|null
     */
    protected ?string $chatInstance = null;

    /**
     * Chat Type
     *
     * Optional. For widgets in inline messages, type of the chat to which the message was sent. Can be either "sender", "private", "group", "supergroup", or "channel".
     * @var string|null
     */
    protected ?string $chatType = null;

    /**
     * Type
     *
     * Type of the query
     * @var WidgetQueryType|null
     */
    protected ?WidgetQueryType $type = null;

    /**
     * Data
     *
     * Data of the query, 1-64 bytes
     * @var string|null
     */
    protected ?string $data = null;

    /**
     * Widget Id
     *
     * Optional. Unique identifier of the shared widget, which sent the query; omitted if the widget isn't shared
     * @var string|null
     */
    protected ?string $widgetId = null;

    public function __construct(
        ?string $id = null,
        ?User $from = null,
        ?Chat $chat = null,
        ?int $messageId = null,
        ?string $inlineMessageId = null,
        ?string $chatInstance = null,
        ?string $chatType = null,
        ?WidgetQueryType $type = null,
        ?string $data = null,
        ?string $widgetId = null
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->chat = $chat;
        $this->messageId = $messageId;
        $this->inlineMessageId = $inlineMessageId;
        $this->chatInstance = $chatInstance;
        $this->chatType = $chatType;
        $this->type = $type;
        $this->data = $data;
        $this->widgetId = $widgetId;
    }

    public static function fromArray(array $data): WidgetQuery {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['inline_message_id'])) {
            $instance->inlineMessageId = $data['inline_message_id'];
        }
        if (isset($data['chat_instance'])) {
            $instance->chatInstance = $data['chat_instance'];
        }
        if (isset($data['chat_type'])) {
            $instance->chatType = $data['chat_type'];
        }
        if (isset($data['type'])) {
            $instance->type = WidgetQueryType::fromArray($data['type']);
        }
        if (isset($data['data'])) {
            $instance->data = $data['data'];
        }
        if (isset($data['widget_id'])) {
            $instance->widgetId = $data['widget_id'];
        }
        return $instance;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
        return $this;
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

    public function getInlineMessageId(): ?string {
        return $this->inlineMessageId;
    }

    public function setInlineMessageId(?string $value): self {
        $this->inlineMessageId = $value;
        return $this;
    }

    public function getChatInstance(): ?string {
        return $this->chatInstance;
    }

    public function setChatInstance(?string $value): self {
        $this->chatInstance = $value;
        return $this;
    }

    public function getChatType(): ?string {
        return $this->chatType;
    }

    public function setChatType(?string $value): self {
        $this->chatType = $value;
        return $this;
    }

    public function getType(): ?WidgetQueryType {
        return $this->type;
    }

    public function setType(?WidgetQueryType $value): self {
        $this->type = $value;
        return $this;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function setData(?string $value): self {
        $this->data = $value;
        return $this;
    }

    public function getWidgetId(): ?string {
        return $this->widgetId;
    }

    public function setWidgetId(?string $value): self {
        $this->widgetId = $value;
        return $this;
    }
}
