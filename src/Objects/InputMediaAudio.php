<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InputMediaAudio {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the result, must be audio
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files »
     * @var string|null
     */
    protected ?string $media = null;

    /**
     * Thumbnail
     *
     * Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @var string|null
     */
    protected ?string $thumbnail = null;

    /**
     * Caption
     *
     * Optional. Caption of the audio to be sent, 0-1024 characters after entities parsing
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
     * Duration
     *
     * Optional. Duration of the audio in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    /**
     * Performer
     *
     * Optional. Performer of the audio
     * @var string|null
     */
    protected ?string $performer = null;

    /**
     * Title
     *
     * Optional. Title of the audio
     * @var string|null
     */
    protected ?string $title = null;

    public function __construct(
        ?string $type = null,
        ?string $media = null,
        ?string $thumbnail = null,
        ?string $caption = null,
        ?string $parseMode = null,
        ?array  $captionEntities = null,
        ?int    $duration = null,
        ?string $performer = null,
        ?string $title = null,
    ) {
        $this->type = $type;
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
    }

    public static function fromArray(array $data): InputMediaAudio {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['media'])) {
            $instance->media = $data['media'];
        }
        if (isset($data['thumbnail'])) {
            $instance->thumbnail = $data['thumbnail'];
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
        if (isset($data['performer'])) {
            $instance->performer = $data['performer'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
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

    public function getMedia(): ?string {
        return $this->media;
    }

    public function setMedia(?string $value): self {
        $this->media = $value;
        return $this;
    }

    public function getThumbnail(): ?string {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $value): self {
        $this->thumbnail = $value;
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

    public function getPerformer(): ?string {
        return $this->performer;
    }

    public function setPerformer(?string $value): self {
        $this->performer = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

}
