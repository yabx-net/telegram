<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultArticle extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be article
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 Bytes
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Title
     *
     * Title of the result
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Input Message Content
     *
     * Content of the message to be sent
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

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

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $title = null,
        ?InputMessageContent  $inputMessageContent = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?string               $url = null,
        ?bool                 $hideUrl = null,
        ?string               $description = null,
        ?string               $thumbnailUrl = null,
        ?int                  $thumbnailWidth = null,
        ?int                  $thumbnailHeight = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->title = $title;
        $this->inputMessageContent = $inputMessageContent;
        $this->replyMarkup = $replyMarkup;
        $this->url = $url;
        $this->hideUrl = $hideUrl;
        $this->description = $description;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    public static function fromArray(array $data): InlineQueryResultArticle {
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
        if (isset($data['input_message_content'])) {
            $instance->inputMessageContent = InputMessageContent::fromArray($data['input_message_content']);
        }
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        if (isset($data['hide_url'])) {
            $instance->hideUrl = $data['hide_url'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
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

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function setInputMessageContent(?InputMessageContent $value): self {
        $this->inputMessageContent = $value;
        return $this;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $value): self {
        $this->replyMarkup = $value;
        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

    public function getHideUrl(): ?bool {
        return $this->hideUrl;
    }

    public function setHideUrl(?bool $value): self {
        $this->hideUrl = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
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
