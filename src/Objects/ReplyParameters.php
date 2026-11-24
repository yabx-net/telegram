<?php

namespace Yabx\Telegram\Objects;

final class ReplyParameters extends AbstractObject {

    /**
     * Message Id
     *
     * Optional. Identifier of the message that will be replied to in the current chat, or in the chat chat_id if it is specified. Required if ephemeral_message_id isn't specified.
     * @var int|null
     */
    protected ?int $messageId = null;

    /**
     * Chat Id
     *
     * Optional. If the message to be replied to is from a different chat, unique identifier for the chat or username of the bot, supergroup or channel in the format @username. Not supported for messages sent on behalf of a business account, messages from channel direct messages chats and ephemeral messages.
     * @var int|string|null
     */
    protected int|string|null $chatId = null;

    /**
     * Allow Sending Without Reply
     *
     * Optional. Pass True if the message should be sent even if the specified message to be replied to is not found. Always False for replies in another chat or forum topic, and sent ephemeral messages. Always True for messages sent on behalf of a business account.
     * @var bool|null
     */
    protected ?bool $allowSendingWithoutReply = null;

    /**
     * Quote
     *
     * Optional. Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities. The message will fail to send if the quote isn't found in the original message. Ignored for ephemeral messages.
     * @var string|null
     */
    protected ?string $quote = null;

    /**
     * Quote Parse Mode
     *
     * Optional. Mode for parsing entities in the quote. See formatting options for more details.
     * @var string|null
     */
    protected ?string $quoteParseMode = null;

    /**
     * Quote Entities
     *
     * Optional. A JSON-serialized list of special entities that appear in the quote. It can be specified instead of quote_parse_mode.
     * @var MessageEntity[]|null
     */
    protected ?array $quoteEntities = null;

    /**
     * Quote Position
     *
     * Optional. Position of the quote in the original message in UTF-16 code units
     * @var int|null
     */
    protected ?int $quotePosition = null;

    /**
     * Ephemeral Message Id
     *
     * Optional. Identifier of the incoming ephemeral message that will be replied to in the current chat. A reply to an ephemeral message must itself be an ephemeral message. An ephemeral message may only be replied to within 15 seconds of being sent. Required if message_id isn't specified.
     * @var int|null
     */
    protected ?int $ephemeralMessageId = null;

    /**
     * Quote Rich Texts
     *
     * Optional. A JSON-serialized list of quoted parts of the rich message to be replied to. If non-empty, quote, quote_parse_mode and quote_entities are ignored.
     * @var array|null
     */
    protected ?array $quoteRichTexts = null;

    /**
     * Checklist Task Id
     *
     * Optional. Identifier of the specific checklist task to be replied to
     * @var int|null
     */
    protected ?int $checklistTaskId = null;

    /**
     * Poll Option Id
     *
     * Optional. Persistent identifier of the specific poll option to be replied to
     * @var string|null
     */
    protected ?string $pollOptionId = null;

    public function __construct(
        ?int            $messageId = null,
        int|string|null $chatId = null,
        ?bool           $allowSendingWithoutReply = null,
        ?string         $quote = null,
        ?string         $quoteParseMode = null,
        ?array          $quoteEntities = null,
        ?int            $quotePosition = null,
        ?int            $ephemeralMessageId = null,
        ?array          $quoteRichTexts = null,
        ?int            $checklistTaskId = null,
        ?string         $pollOptionId = null,
    ) {
        $this->messageId = $messageId;
        $this->chatId = $chatId;
        $this->allowSendingWithoutReply = $allowSendingWithoutReply;
        $this->quote = $quote;
        $this->quoteParseMode = $quoteParseMode;
        $this->quoteEntities = $quoteEntities;
        $this->quotePosition = $quotePosition;
        $this->ephemeralMessageId = $ephemeralMessageId;
        $this->quoteRichTexts = $quoteRichTexts;
        $this->checklistTaskId = $checklistTaskId;
        $this->pollOptionId = $pollOptionId;
    }

    public static function fromArray(array $data): ReplyParameters {
        $instance = new self();
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['chat_id'])) {
            $instance->chatId = $data['chat_id'];
        }
        if (isset($data['allow_sending_without_reply'])) {
            $instance->allowSendingWithoutReply = $data['allow_sending_without_reply'];
        }
        if (isset($data['quote'])) {
            $instance->quote = $data['quote'];
        }
        if (isset($data['quote_parse_mode'])) {
            $instance->quoteParseMode = $data['quote_parse_mode'];
        }
        if (isset($data['quote_entities'])) {
            $instance->quoteEntities = [];
            foreach ($data['quote_entities'] as $item) {
                $instance->quoteEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['quote_position'])) {
            $instance->quotePosition = $data['quote_position'];
        }
        if (isset($data['ephemeral_message_id'])) {
            $instance->ephemeralMessageId = $data['ephemeral_message_id'];
        }
        if (isset($data['quote_rich_texts'])) {
            $instance->quoteRichTexts = array_map(fn(mixed $item) => RichText::fromMixed($item), $data['quote_rich_texts']);
        }
        if (isset($data['checklist_task_id'])) {
            $instance->checklistTaskId = $data['checklist_task_id'];
        }
        if (isset($data['poll_option_id'])) {
            $instance->pollOptionId = $data['poll_option_id'];
        }
        return $instance;
    }

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

    public function getChatId(): int|string|null {
        return $this->chatId;
    }

    public function setChatId(int|string|null $value): self {
        $this->chatId = $value;
        return $this;
    }

    public function getAllowSendingWithoutReply(): ?bool {
        return $this->allowSendingWithoutReply;
    }

    public function setAllowSendingWithoutReply(?bool $value): self {
        $this->allowSendingWithoutReply = $value;
        return $this;
    }

    public function getQuote(): ?string {
        return $this->quote;
    }

    public function setQuote(?string $value): self {
        $this->quote = $value;
        return $this;
    }

    public function getQuoteParseMode(): ?string {
        return $this->quoteParseMode;
    }

    public function setQuoteParseMode(?string $value): self {
        $this->quoteParseMode = $value;
        return $this;
    }

    public function getQuoteEntities(): ?array {
        return $this->quoteEntities;
    }

    public function setQuoteEntities(?array $value): self {
        $this->quoteEntities = $value;
        return $this;
    }

    public function getQuotePosition(): ?int {
        return $this->quotePosition;
    }

    public function setQuotePosition(?int $value): self {
        $this->quotePosition = $value;
        return $this;
    }

    public function getEphemeralMessageId(): ?int {
        return $this->ephemeralMessageId;
    }

    public function setEphemeralMessageId(?int $value): self {
        $this->ephemeralMessageId = $value;
        return $this;
    }

    public function getQuoteRichTexts(): ?array {
        return $this->quoteRichTexts;
    }

    public function setQuoteRichTexts(?array $value): self {
        $this->quoteRichTexts = $value;
        return $this;
    }

    public function getChecklistTaskId(): ?int {
        return $this->checklistTaskId;
    }

    public function setChecklistTaskId(?int $value): self {
        $this->checklistTaskId = $value;
        return $this;
    }

    public function getPollOptionId(): ?string {
        return $this->pollOptionId;
    }

    public function setPollOptionId(?string $value): self {
        $this->pollOptionId = $value;
        return $this;
    }

}
