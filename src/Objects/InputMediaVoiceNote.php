<?php

namespace Yabx\Telegram\Objects;

/**
 * Represents a voice message file to be sent.
 * @link https://core.telegram.org/bots/api#inputmediavoicenote
 */
final class InputMediaVoiceNote extends AbstractObject {

    /**
     * Type
     *
     * Type of the media, must be voice_note
     * @var string
     */
    protected string $type = 'voice_note';

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files »
     * @var string|null
     */
    protected ?string $media = null;

    /**
     * Caption
     *
     * Optional. Caption of the voice message to be sent, 0-1024 characters after entities parsing
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
     * Duration
     *
     * Optional. Duration of the voice message in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    public function __construct(
        ?string $media = null,
        ?string $caption = null,
        ?string $parseMode = null,
        ?array $captionEntities = null,
        ?int $duration = null
    ) {
        $this->media = $media;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->duration = $duration;
    }

    public static function fromArray(array $data): InputMediaVoiceNote {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['media'])) {
            $instance->media = $data['media'];
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
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMedia(): ?string {
        return $this->media;
    }

    public function setMedia(?string $value): self {
        $this->media = $value;
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

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(?int $value): self {
        $this->duration = $value;
        return $this;
    }
}
