<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultAudio {

    /**
     * Type
     *
     * Type of the result, must be audio
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
     * Audio Url
     *
     * A valid URL for the audio file
     * @var string
     */
    protected string $audioUrl;

    /**
     * Title
     *
     * Title
     * @var string
     */
    protected string $title;

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
     * Optional. Mode for parsing entities in the audio caption. See formatting options for more details.
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
     * Performer
     *
     * Optional. Performer
     * @var string|null
     */
    protected ?string $performer = null;

    /**
     * Audio Duration
     *
     * Optional. Audio duration in seconds
     * @var int|null
     */
    protected ?int $audioDuration = null;

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
     * Optional. Content of the message to be sent instead of the audio
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['audio_url'])) {
            $this->audioUrl = $data['audio_url'];
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
        if (isset($data['performer'])) {
            $this->performer = $data['performer'];
        }
        if (isset($data['audio_duration'])) {
            $this->audioDuration = $data['audio_duration'];
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

    public function getAudioUrl(): string {
        return $this->audioUrl;
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

    public function getPerformer(): ?string {
        return $this->performer;
    }

    public function getAudioDuration(): ?int {
        return $this->audioDuration;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
