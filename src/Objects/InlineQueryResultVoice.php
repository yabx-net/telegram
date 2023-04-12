<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultVoice extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be voice
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
     * Voice Url
     *
     * A valid URL for the voice recording
     * @var string|null
     */
    protected ?string $voiceUrl = null;

    /**
     * Title
     *
     * Recording title
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Caption
     *
     * Optional. Caption, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the voice message caption. See formatting options for more details.
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
     * Voice Duration
     *
     * Optional. Recording duration in seconds
     * @var int|null
     */
    protected ?int $voiceDuration = null;

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
     * Optional. Content of the message to be sent instead of the voice recording
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $voiceUrl = null,
        ?string               $title = null,
        ?string               $caption = null,
        ?string               $parseMode = null,
        ?array                $captionEntities = null,
        ?int                  $voiceDuration = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->voiceUrl = $voiceUrl;
        $this->title = $title;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->voiceDuration = $voiceDuration;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
    }

    public static function fromArray(array $data): InlineQueryResultVoice {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['voice_url'])) {
            $instance->voiceUrl = $data['voice_url'];
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
        if (isset($data['voice_duration'])) {
            $instance->voiceDuration = $data['voice_duration'];
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

    public function getVoiceUrl(): ?string {
        return $this->voiceUrl;
    }

    public function setVoiceUrl(?string $value): self {
        $this->voiceUrl = $value;
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

    public function getVoiceDuration(): ?int {
        return $this->voiceDuration;
    }

    public function setVoiceDuration(?int $value): self {
        $this->voiceDuration = $value;
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
