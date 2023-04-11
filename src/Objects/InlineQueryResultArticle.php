<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultArticle {

    /**
     * Type
     *
     * Type of the result, must be article
     * @var string
     */
    protected string $type;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 Bytes
     * @var string
     */
    protected string $id;

    /**
     * Title
     *
     * Title of the result
     * @var string
     */
    protected string $title;

    /**
     * Input Message Content
     *
     * Content of the message to be sent
     * @var InputMessageContent
     */
    protected InputMessageContent $inputMessageContent;

    /**
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;

    /**
     * Url
     *
     * Optional. URL of the result
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * Hide Url
     *
     * Optional. Pass True if you don't want the URL to be shown in the message
     * @var bool|null
     */
    protected ?bool $hideUrl = null;

    /**
     * Description
     *
     * Optional. Short description of the result
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Thumbnail Url
     *
     * Optional. Url of the thumbnail for the result
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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['input_message_content'])) {
            $this->inputMessageContent = new InputMessageContent($data['input_message_content']);
        }
        if (isset($data['reply_markup'])) {
            $this->replyMarkup = new InlineKeyboardMarkup($data['reply_markup']);
        }
        if (isset($data['url'])) {
            $this->url = $data['url'];
        }
        if (isset($data['hide_url'])) {
            $this->hideUrl = $data['hide_url'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
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

    public function getInputMessageContent(): InputMessageContent {
        return $this->inputMessageContent;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function getHideUrl(): ?bool {
        return $this->hideUrl;
    }

    public function getDescription(): ?string {
        return $this->description;
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

    public function getRawData(): array {
        return $this->rawData;
    }

}
