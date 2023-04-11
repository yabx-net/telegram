<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class CallbackQuery {

    use ObjectTrait;

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
     * Message
     *
     * Optional. Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
     * @var Message|null
     */
    protected ?Message $message = null;

    /**
     * Inline Message Id
     *
     * Optional. Identifier of the message sent via the bot in inline mode, that originated the query.
     * @var string|null
     */
    protected ?string $inlineMessageId = null;

    /**
     * Chat Instance
     *
     * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
     * @var string|null
     */
    protected ?string $chatInstance = null;

    /**
     * Data
     *
     * Optional. Data associated with the callback button. Be aware that the message originated the query can contain no callback buttons with this data.
     * @var string|null
     */
    protected ?string $data = null;

    /**
     * Game Short Name
     *
     * Optional. Short name of a Game to be returned, serves as the unique identifier for the game
     * @var string|null
     */
    protected ?string $gameShortName = null;

    public function __construct(
        ?string  $id = null,
        ?User    $from = null,
        ?Message $message = null,
        ?string  $inlineMessageId = null,
        ?string  $chatInstance = null,
        ?string  $data = null,
        ?string  $gameShortName = null,
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->message = $message;
        $this->inlineMessageId = $inlineMessageId;
        $this->chatInstance = $chatInstance;
        $this->data = $data;
        $this->gameShortName = $gameShortName;
    }

    public static function fromArray(array $data): CallbackQuery {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['message'])) {
            $instance->message = Message::fromArray($data['message']);
        }
        if (isset($data['inline_message_id'])) {
            $instance->inlineMessageId = $data['inline_message_id'];
        }
        if (isset($data['chat_instance'])) {
            $instance->chatInstance = $data['chat_instance'];
        }
        if (isset($data['data'])) {
            $instance->data = $data['data'];
        }
        if (isset($data['game_short_name'])) {
            $instance->gameShortName = $data['game_short_name'];
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

    public function getMessage(): ?Message {
        return $this->message;
    }

    public function setMessage(?Message $value): self {
        $this->message = $value;
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

    public function getData(): ?string {
        return $this->data;
    }

    public function setData(?string $value): self {
        $this->data = $value;
        return $this;
    }

    public function getGameShortName(): ?string {
        return $this->gameShortName;
    }

    public function setGameShortName(?string $value): self {
        $this->gameShortName = $value;
        return $this;
    }

}
