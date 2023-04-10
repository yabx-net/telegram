<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultDocument {

    /**
     * Type
     *
     * Type of the result, must be document
     * @var string
     */
    protected string $type;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 bytes
     * @var string
     */
    protected string $id;

    /**
     * Title
     *
     * Title for the result
     * @var string
     */
    protected string $title;

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
     * @var string
     */
    protected string $documentUrl;

    /**
     * Mime Type
     *
     * MIME type of the content of the file, either “application/pdf” or “application/zip”
     * @var string
     */
    protected string $mimeType;

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


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }
        if (isset($data['parse_mode'])) {
            $this->parseMode = $data['parse_mode'];
        }
        if (isset($data['caption_entities'])) {
            $this->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $this->captionEntities[] = new MessageEntity($item);
            }
        }
        if (isset($data['document_url'])) {
            $this->documentUrl = $data['document_url'];
        }
        if (isset($data['mime_type'])) {
            $this->mimeType = $data['mime_type'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['reply_markup'])) {
            $this->replyMarkup = new InlineKeyboardMarkup($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $this->inputMessageContent = new InputMessageContent($data['input_message_content']);
        }
        if (isset($data['thumbnail_url'])) {
            $this->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_width'])) {
            $this->thumbnailWidth = $data['thumbnail_width'];
        }
        if (isset($data['thumbnail_height'])) {
            $this->thumbnailHeight = $data['thumbnail_height'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function getDocumentUrl(): string {
        return $this->documentUrl;
    }

    public function getMimeType(): string {
        return $this->mimeType;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function getThumbnailWidth(): ?int {
        return $this->thumbnailWidth;
    }

    public function getThumbnailHeight(): ?int {
        return $this->thumbnailHeight;
    }


}
