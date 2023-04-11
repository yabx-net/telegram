<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InlineQueryResultDocument {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the result, must be document
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
     * Title
     *
     * Title for the result
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Caption
     *
     * Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the document caption. See formatting options for more details.
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Caption Entities
     *
     * Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @var MessageEntity[]|null
     */
    protected ?array $captionEntities = null;

    /**
     * Document Url
     *
     * A valid URL for the file
     * @var string|null
     */
    protected ?string $documentUrl = null;

    /**
     * Mime Type
     *
     * MIME type of the content of the file, either “application/pdf” or “application/zip”
     * @var string|null
     */
    protected ?string $mimeType = null;

    /**
     * Description
     *
     * Optional. Short description of the result
     * @var string|null
     */
    protected ?string $description = null;

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
     * Optional. Content of the message to be sent instead of the file
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    /**
     * Thumbnail Url
     *
     * Optional. URL of the thumbnail (JPEG only) for the file
     * @var string|null
     */
    protected ?string $thumbnailUrl = null;

    /**
     * Thumbnail Width
     *
     * Optional. Thumbnail width
     * @var int|null
     */
    protected ?int $thumbnailWidth = null;

    /**
     * Thumbnail Height
     *
     * Optional. Thumbnail height
     * @var int|null
     */
    protected ?int $thumbnailHeight = null;

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $title = null,
        ?string               $caption = null,
        ?string               $parseMode = null,
        ?array                $captionEntities = null,
        ?string               $documentUrl = null,
        ?string               $mimeType = null,
        ?string               $description = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
        ?string               $thumbnailUrl = null,
        ?int                  $thumbnailWidth = null,
        ?int                  $thumbnailHeight = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->title = $title;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->documentUrl = $documentUrl;
        $this->mimeType = $mimeType;
        $this->description = $description;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    public static function fromArray(array $data): InlineQueryResultDocument {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['caption'])) {
            $instance->caption = $data['caption'];
        }
        if (isset($data['parse_mode'])) {
            $instance->parseMode = $data['parse_mode'];
        }
        if (isset($data['caption_entities'])) {
            $instance->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $instance->captionEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['document_url'])) {
            $instance->documentUrl = $data['document_url'];
        }
        if (isset($data['mime_type'])) {
            $instance->mimeType = $data['mime_type'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $instance->inputMessageContent = InputMessageContent::fromArray($data['input_message_content']);
        }
        if (isset($data['thumbnail_url'])) {
            $instance->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_width'])) {
            $instance->thumbnailWidth = $data['thumbnail_width'];
        }
        if (isset($data['thumbnail_height'])) {
            $instance->thumbnailHeight = $data['thumbnail_height'];
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

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function setCaption(?string $value): self {
        $this->caption = $value;
        return $this;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function setParseMode(?string $value): self {
        $this->parseMode = $value;
        return $this;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function setCaptionEntities(?array $value): self {
        $this->captionEntities = $value;
        return $this;
    }

    public function getDocumentUrl(): ?string {
        return $this->documentUrl;
    }

    public function setDocumentUrl(?string $value): self {
        $this->documentUrl = $value;
        return $this;
    }

    public function getMimeType(): ?string {
        return $this->mimeType;
    }

    public function setMimeType(?string $value): self {
        $this->mimeType = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
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

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $value): self {
        $this->thumbnailUrl = $value;
        return $this;
    }

    public function getThumbnailWidth(): ?int {
        return $this->thumbnailWidth;
    }

    public function setThumbnailWidth(?int $value): self {
        $this->thumbnailWidth = $value;
        return $this;
    }

    public function getThumbnailHeight(): ?int {
        return $this->thumbnailHeight;
    }

    public function setThumbnailHeight(?int $value): self {
        $this->thumbnailHeight = $value;
        return $this;
    }

}
