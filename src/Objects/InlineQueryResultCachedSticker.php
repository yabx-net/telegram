<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultCachedSticker extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be sticker
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 bytes
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Sticker File Id
     *
     * A valid file identifier of the sticker
     * @var string|null
     */
    protected ?string $stickerFileId = null;

    /**
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;

    /**
     * Input Message Content
     *
     * Optional. Content of the message to be sent instead of the sticker
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $stickerFileId = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->stickerFileId = $stickerFileId;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
    }

    public static function fromArray(array $data): InlineQueryResultCachedSticker {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['sticker_file_id'])) {
            $instance->stickerFileId = $data['sticker_file_id'];
        }
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $instance->inputMessageContent = InputMessageContent::fromArray($data['input_message_content']);
        }
        return $instance;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getStickerFileId(): ?string {
        return $this->stickerFileId;
    }

    public function setStickerFileId(?string $value): self {
        $this->stickerFileId = $value;
        return $this;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $value): self {
        $this->replyMarkup = $value;
        return $this;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function setInputMessageContent(?InputMessageContent $value): self {
        $this->inputMessageContent = $value;
        return $this;
    }

}
