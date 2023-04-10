<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultPhoto {

    /**
     * Type
     *
     * Type of the result, must be photo
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
     * Photo Url
     *
     * A valid URL of the photo. Photo must be in JPEG format. Photo size must not exceed 5MB
     * @var string
     */
    protected string $photoUrl;

    /**
     * Thumbnail Url
     *
     * URL of the thumbnail for the photo
     * @var string
     */
    protected string $thumbnailUrl;

    /**
     * Photo Width
     *
     * Optional. Width of the photo
     * @var int|null
     */
    protected ?int $photoWidth = null;

    /**
     * Photo Height
     *
     * Optional. Height of the photo
     * @var int|null
     */
    protected ?int $photoHeight = null;

    /**
     * Title
     *
     * Optional. Title for the result
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Description
     *
     * Optional. Short description of the result
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Caption
     *
     * Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
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
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;

    /**
     * Input Message Content
     *
     * Optional. Content of the message to be sent instead of the photo
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['photo_url'])) {
            $this->photoUrl = $data['photo_url'];
        }
        if (isset($data['thumbnail_url'])) {
            $this->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['photo_width'])) {
            $this->photoWidth = $data['photo_width'];
        }
        if (isset($data['photo_height'])) {
            $this->photoHeight = $data['photo_height'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
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
        if (isset($data['reply_markup'])) {
            $this->replyMarkup = new InlineKeyboardMarkup($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $this->inputMessageContent = new InputMessageContent($data['input_message_content']);
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getPhotoUrl(): string {
        return $this->photoUrl;
    }

    public function getThumbnailUrl(): string {
        return $this->thumbnailUrl;
    }

    public function getPhotoWidth(): ?int {
        return $this->photoWidth;
    }

    public function getPhotoHeight(): ?int {
        return $this->photoHeight;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function getDescription(): ?string {
        return $this->description;
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

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }


}
