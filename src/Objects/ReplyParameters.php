<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ReplyParameters {

    use ObjectTrait;

    /**
     * Message Id
     *
     * Identifier of the message that will be replied to in the current chat, or in the chat chat_id if it is specified
     * @var int|null
     */
    protected ?int $messageId = null;

    /**
     * Chat Id
     *
     * Optional. If the message to be replied to is from a different chat, unique identifier for the chat or username of the channel (in the format @channelusername). Not supported for messages sent on behalf of a business account.
     * @var int|string|null
     */
    protected int|string|null $chatId = null;

    /**
     * Allow Sending Without Reply
     *
     * Optional. Pass True if the message should be sent even if the specified message to be replied to is not found. Always False for replies in another chat or forum topic. Always True for messages sent on behalf of a business account.
     * @var bool|null
     */
    protected ?bool $allowSendingWithoutReply = null;

    /**
     * Quote
     *
     * Optional. Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, and custom_emoji entities. The message will fail to send if the quote isn't found in the original message.
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
        return $instance;
    }

    public function __construct(
        ?int            $messageId = null,
        int|string|null $chatId = null,
        ?bool           $allowSendingWithoutReply = null,
        ?string         $quote = null,
        ?string         $quoteParseMode = null,
        ?array          $quoteEntities = null,
        ?int            $quotePosition = null,
    ) {
        $this->messageId = $messageId;
        $this->chatId = $chatId;
        $this->allowSendingWithoutReply = $allowSendingWithoutReply;
        $this->quote = $quote;
        $this->quoteParseMode = $quoteParseMode;
        $this->quoteEntities = $quoteEntities;
        $this->quotePosition = $quotePosition;
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

}
