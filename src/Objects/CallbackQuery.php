<?php

namespace Yabx\Telegram\Objects;

class CallbackQuery {

    /**
     * Id
     *
     * Unique identifier for this query
     * @var string
     */
    protected string $id;

    /**
     * From
     *
     * Sender
     * @var User
     */
    protected User $from;

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
     * @var string
     */
    protected string $chatInstance;

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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['message'])) {
            $this->message = new Message($data['message']);
        }
        if (isset($data['inline_message_id'])) {
            $this->inlineMessageId = $data['inline_message_id'];
        }
        if (isset($data['chat_instance'])) {
            $this->chatInstance = $data['chat_instance'];
        }
        if (isset($data['data'])) {
            $this->data = $data['data'];
        }
        if (isset($data['game_short_name'])) {
            $this->gameShortName = $data['game_short_name'];
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getFrom(): User {
        return $this->from;
    }

    public function getMessage(): ?Message {
        return $this->message;
    }

    public function getInlineMessageId(): ?string {
        return $this->inlineMessageId;
    }

    public function getChatInstance(): string {
        return $this->chatInstance;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function getGameShortName(): ?string {
        return $this->gameShortName;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
