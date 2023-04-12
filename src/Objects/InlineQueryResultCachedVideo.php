<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultCachedVideo extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be video
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
     * Video File Id
     *
     * A valid file identifier for the video file
     * @var string|null
     */
    protected ?string $videoFileId = null;

    /**
     * Title
     *
     * Title for the result
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
     * Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the video caption. See formatting options for more details.
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
     * Optional. Content of the message to be sent instead of the video
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $videoFileId = null,
        ?string               $title = null,
        ?string               $description = null,
        ?string               $caption = null,
        ?string               $parseMode = null,
        ?array                $captionEntities = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->videoFileId = $videoFileId;
        $this->title = $title;
        $this->description = $description;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
    }

    public static function fromArray(array $data): InlineQueryResultCachedVideo {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['video_file_id'])) {
            $instance->videoFileId = $data['video_file_id'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
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

    public function getVideoFileId(): ?string {
        return $this->videoFileId;
    }

    public function setVideoFileId(?string $value): self {
        $this->videoFileId = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
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
