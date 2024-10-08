<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InputMediaDocument {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the result, must be document
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
     * Disable Content Type Detection
     *
     * Optional. Disables automatic server-side content type detection for files uploaded using multipart/form-data. Always True, if the document is sent as part of an album.
     * @var bool|null
     */
    protected ?bool $disableContentTypeDetection = null;

    public function __construct(
        ?string $type = null,
        ?string $media = null,
        ?string $thumbnail = null,
        ?string $caption = null,
        ?string $parseMode = null,
        ?array  $captionEntities = null,
        ?bool   $disableContentTypeDetection = null,
    ) {
        $this->type = $type;
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->disableContentTypeDetection = $disableContentTypeDetection;
    }

    public static function fromArray(array $data): InputMediaDocument {
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
        if (isset($data['disable_content_type_detection'])) {
            $instance->disableContentTypeDetection = $data['disable_content_type_detection'];
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

    public function getDisableContentTypeDetection(): ?bool {
        return $this->disableContentTypeDetection;
    }

    public function setDisableContentTypeDetection(?bool $value): self {
        $this->disableContentTypeDetection = $value;
        return $this;
    }

}
